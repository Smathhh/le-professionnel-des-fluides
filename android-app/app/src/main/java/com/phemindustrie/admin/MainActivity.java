package com.phemindustrie.admin;

import android.Manifest;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.graphics.drawable.GradientDrawable;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.provider.MediaStore;
import android.view.Gravity;
import android.view.KeyEvent;
import android.view.View;
import android.webkit.PermissionRequest;
import android.webkit.ValueCallback;
import android.webkit.WebChromeClient;
import android.webkit.WebResourceRequest;
import android.webkit.WebResourceResponse;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.ScrollView;
import android.widget.TextView;
import android.widget.Toast;

import java.io.File;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.HashMap;
import java.util.Map;

public class MainActivity extends Activity {

    private static final String PREFS_NAME = "PhemAdminPrefs";
    private static final String KEY_SERVER_URL = "server_url";
    public static final String DEFAULT_PROD_URL = "https://le-professionnel-des-fluides.onrender.com";
    public static final String DEFAULT_LAN_URL = "http://192.168.11.107:8001";
    public static final String DEFAULT_EMULATOR_URL = "http://10.0.2.2:8001";

    private WebView webView;
    private ProgressBar progressBar;
    private FrameLayout settingsContainer;
    private EditText editServerUrl;
    private TextView txtStatus;
    private ValueCallback<Uri[]> fileUploadCallback;
    private static final int FILE_CHOOSER_REQUEST = 1001;
    private final Handler timeoutHandler = new Handler(Looper.getMainLooper());
    private Runnable timeoutRunnable;
    private boolean pageLoaded = false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        FrameLayout root = new FrameLayout(this);
        root.setBackgroundColor(0xFF1E2430); // PHEM Charcoal

        // Main WebView
        webView = new WebView(this);
        webView.setBackgroundColor(0xFF0F172A);
        configureWebView(webView);

        // Progress bar
        progressBar = new ProgressBar(this, null, android.R.attr.progressBarStyleHorizontal);
        progressBar.setMax(100);
        progressBar.setLayoutParams(new FrameLayout.LayoutParams(
                FrameLayout.LayoutParams.MATCH_PARENT, 10));
        progressBar.setVisibility(View.GONE);

        // Settings / Connection Overlay with Official Logo
        settingsContainer = createSettingsView();
        settingsContainer.setVisibility(View.GONE);

        root.addView(webView, new FrameLayout.LayoutParams(
                FrameLayout.LayoutParams.MATCH_PARENT, FrameLayout.LayoutParams.MATCH_PARENT));
        root.addView(progressBar);
        root.addView(settingsContainer, new FrameLayout.LayoutParams(
                FrameLayout.LayoutParams.MATCH_PARENT, FrameLayout.LayoutParams.MATCH_PARENT));

        setContentView(root);
        requestAppPermissions();
        loadAppUrl();
    }

    private void requestAppPermissions() {
        if (Build.VERSION.SDK_INT >= 23) {
            if (checkSelfPermission(Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED) {
                requestPermissions(new String[]{Manifest.permission.CAMERA}, 2001);
            }
        }
    }

    private boolean isNetworkAvailable() {
        try {
            ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            if (cm != null) {
                NetworkInfo info = cm.getActiveNetworkInfo();
                return info != null && info.isConnected();
            }
        } catch (Exception ignored) {}
        return true;
    }

    private void configureWebView(WebView view) {
        WebSettings settings = view.getSettings();
        settings.setJavaScriptEnabled(true);
        settings.setDomStorageEnabled(true);
        settings.setDatabaseEnabled(true);
        settings.setAllowFileAccess(true);
        settings.setAllowContentAccess(true);
        settings.setMediaPlaybackRequiresUserGesture(false);
        settings.setUseWideViewPort(true);
        settings.setLoadWithOverviewMode(true);
        settings.setBuiltInZoomControls(false);

        // Cache optimization
        File cacheDir = new File(getCacheDir(), "phem_webview_cache");
        if (!cacheDir.exists()) {
            cacheDir.mkdirs();
        }
        settings.setCacheMode(isNetworkAvailable() ? WebSettings.LOAD_DEFAULT : WebSettings.LOAD_CACHE_ELSE_NETWORK);

        view.setWebChromeClient(new WebChromeClient() {
            @Override
            public void onProgressChanged(WebView view, int newProgress) {
                if (newProgress < 100) {
                    progressBar.setVisibility(View.VISIBLE);
                    progressBar.setProgress(newProgress);
                } else {
                    progressBar.setVisibility(View.GONE);
                }
            }

            @Override
            public boolean onShowFileChooser(WebView webView, ValueCallback<Uri[]> filePathCallback, FileChooserParams fileChooserParams) {
                if (fileUploadCallback != null) {
                    fileUploadCallback.onReceiveValue(null);
                }
                fileUploadCallback = filePathCallback;

                Intent galleryIntent = new Intent(Intent.ACTION_GET_CONTENT);
                galleryIntent.addCategory(Intent.CATEGORY_OPENABLE);
                galleryIntent.setType("image/*");

                Intent cameraIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                Intent chooser = Intent.createChooser(galleryIntent, "Photo ou Galerie");
                chooser.putExtra(Intent.EXTRA_INITIAL_INTENTS, new Intent[]{cameraIntent});
                startActivityForResult(chooser, FILE_CHOOSER_REQUEST);
                return true;
            }

            @Override
            public void onPermissionRequest(PermissionRequest request) {
                request.grant(request.getResources());
            }
        });

        view.setWebViewClient(new WebViewClient() {
            @Override
            public void onPageStarted(WebView view, String url, Bitmap favicon) {
                pageLoaded = false;
                startLoadWatchdog();
            }

            @Override
            public void onPageFinished(WebView view, String url) {
                pageLoaded = true;
                cancelLoadWatchdog();
                progressBar.setVisibility(View.GONE);
            }

            @Override
            public void onReceivedError(WebView view, int errorCode, String description, String failingUrl) {
                cancelLoadWatchdog();
                progressBar.setVisibility(View.GONE);
                showSettingsOverlay("Erreur de connexion (" + description + ")");
            }

            @Override
            public WebResourceResponse shouldInterceptRequest(WebView view, WebResourceRequest request) {
                String url = request.getUrl().toString();
                if (url.contains("loca.lt")) {
                    try {
                        HttpURLConnection conn = (HttpURLConnection) new URL(url).openConnection();
                        conn.setRequestProperty("Bypass-Tunnel-Reminder", "true");
                        conn.setRequestProperty("User-Agent", request.getRequestHeaders().get("User-Agent"));
                        conn.connect();
                        String contentType = conn.getContentType();
                        String mimeType = "text/html";
                        String encoding = "utf-8";
                        if (contentType != null) {
                            String[] parts = contentType.split(";");
                            mimeType = parts[0].trim();
                        }
                        InputStream is = conn.getInputStream();
                        return new WebResourceResponse(mimeType, encoding, is);
                    } catch (Exception ignored) {
                    }
                }
                return super.shouldInterceptRequest(view, request);
            }

            @Override
            public boolean shouldOverrideUrlLoading(WebView view, WebResourceRequest request) {
                Uri uri = request.getUrl();
                String scheme = uri.getScheme();
                if ("whatsapp".equalsIgnoreCase(scheme) || "tel".equalsIgnoreCase(scheme) || "mailto".equalsIgnoreCase(scheme)) {
                    try {
                        Intent intent = new Intent(Intent.ACTION_VIEW, uri);
                        startActivity(intent);
                        return true;
                    } catch (Exception e) {
                        return false;
                    }
                }
                return false;
            }
        });
    }

    private FrameLayout createSettingsView() {
        FrameLayout container = new FrameLayout(this);
        container.setBackgroundColor(0xF50F172A);

        ScrollView scroll = new ScrollView(this);
        LinearLayout layout = new LinearLayout(this);
        layout.setOrientation(LinearLayout.VERTICAL);
        layout.setGravity(Gravity.CENTER_HORIZONTAL);
        layout.setPadding(50, 80, 50, 80);

        // 1. Official Logo
        ImageView logoView = new ImageView(this);
        logoView.setImageResource(R.drawable.app_logo);
        LinearLayout.LayoutParams logoParams = new LinearLayout.LayoutParams(260, 260);
        logoParams.setMargins(0, 0, 0, 30);
        logoView.setLayoutParams(logoParams);
        layout.addView(logoView);

        // 2. Title & Subtitle
        TextView title = new TextView(this);
        title.setText("PHEM INDUSTRIE S.A.R.L");
        title.setTextColor(0xFFFFFFFF);
        title.setTextSize(22);
        title.setGravity(Gravity.CENTER);
        title.setPadding(0, 0, 0, 10);
        layout.addView(title);

        TextView subtitle = new TextView(this);
        subtitle.setText("Hydraulique & Pneumatique • Connexion Serveur");
        subtitle.setTextColor(0xFFF43F5E); // PHEM Crimson
        subtitle.setTextSize(13);
        subtitle.setGravity(Gravity.CENTER);
        subtitle.setPadding(0, 0, 0, 40);
        layout.addView(subtitle);

        // Status message
        txtStatus = new TextView(this);
        txtStatus.setText("Vérification de la connexion...");
        txtStatus.setTextColor(0xFFFCA5A5);
        txtStatus.setTextSize(13);
        txtStatus.setGravity(Gravity.CENTER);
        txtStatus.setPadding(20, 20, 20, 30);
        layout.addView(txtStatus);

        // Fast Preset 1: Production Cloud (Render)
        Button btnProd = createStyledButton("Serveur En Ligne (Production HTTPS)", 0xFFC81E2B);
        btnProd.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                saveServerUrl(DEFAULT_PROD_URL);
                hideSettingsAndReload();
            }
        });
        layout.addView(btnProd);

        // Fast Preset 2: Emulator Mode
        Button btnEmu = createStyledButton("Mode Émulateur Android (10.0.2.2:8001)", 0xFF334155);
        btnEmu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                saveServerUrl(DEFAULT_EMULATOR_URL);
                hideSettingsAndReload();
            }
        });
        layout.addView(btnEmu);

        // Fast Preset 3: Wi-Fi Local Mode
        Button btnLan = createStyledButton("Mode Réseau Local Wi-Fi (Bureau)", 0xFF1E293B);
        btnLan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                saveServerUrl(DEFAULT_LAN_URL);
                hideSettingsAndReload();
            }
        });
        layout.addView(btnLan);

        // Custom URL label
        TextView customLabel = new TextView(this);
        customLabel.setText("Ou entrez une adresse personnalisée :");
        customLabel.setTextColor(0xFF94A3B8);
        customLabel.setTextSize(12);
        customLabel.setPadding(0, 30, 0, 15);
        layout.addView(customLabel);

        // URL input
        editServerUrl = new EditText(this);
        editServerUrl.setBackgroundColor(0xFF1E293B);
        editServerUrl.setTextColor(0xFFFFFFFF);
        editServerUrl.setPadding(30, 30, 30, 30);
        editServerUrl.setText(getServerUrl());
        editServerUrl.setLayoutParams(new LinearLayout.LayoutParams(
                LinearLayout.LayoutParams.MATCH_PARENT, LinearLayout.LayoutParams.WRAP_CONTENT));
        layout.addView(editServerUrl);

        // Save & Connect button
        Button btnSave = createStyledButton("Enregistrer et Connecter", 0xFF10B981); // Emerald
        btnSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String val = editServerUrl.getText().toString().trim();
                if (!val.isEmpty()) {
                    saveServerUrl(val);
                    hideSettingsAndReload();
                }
            }
        });
        layout.addView(btnSave);

        scroll.addView(layout);
        container.addView(scroll);
        return container;
    }

    private Button createStyledButton(String text, int bgColor) {
        Button btn = new Button(this);
        btn.setText(text);
        btn.setTextColor(0xFFFFFFFF);
        btn.setTextSize(14);
        btn.setAllCaps(false);

        GradientDrawable shape = new GradientDrawable();
        shape.setCornerRadius(24);
        shape.setColor(bgColor);
        btn.setBackground(shape);

        LinearLayout.LayoutParams params = new LinearLayout.LayoutParams(
                LinearLayout.LayoutParams.MATCH_PARENT, 130);
        params.setMargins(0, 15, 0, 15);
        btn.setLayoutParams(params);
        return btn;
    }

    private void showSettingsOverlay(String statusMsg) {
        txtStatus.setText(statusMsg);
        editServerUrl.setText(getServerUrl());
        settingsContainer.setVisibility(View.VISIBLE);
    }

    private void hideSettingsAndReload() {
        settingsContainer.setVisibility(View.GONE);
        loadAppUrl();
    }

    private boolean isEmulator() {
        return Build.FINGERPRINT.startsWith("generic")
                || Build.FINGERPRINT.startsWith("unknown")
                || Build.MODEL.contains("google_sdk")
                || Build.MODEL.contains("Emulator")
                || Build.MODEL.contains("Android SDK built for x86")
                || Build.MANUFACTURER.contains("Genymotion")
                || (Build.BRAND.startsWith("generic") && Build.DEVICE.startsWith("generic"))
                || "google_sdk".equals(Build.PRODUCT);
    }

    private String getDefaultUrl() {
        if (isEmulator()) {
            return DEFAULT_EMULATOR_URL;
        }
        return DEFAULT_PROD_URL;
    }

    private void startLoadWatchdog() {
        cancelLoadWatchdog();
        timeoutRunnable = new Runnable() {
            @Override
            public void run() {
                if (!pageLoaded) {
                    webView.stopLoading();
                    progressBar.setVisibility(View.GONE);
                    showSettingsOverlay("Délai dépassé — vérifiez le serveur ou choisissez un autre mode.");
                }
            }
        };
        timeoutHandler.postDelayed(timeoutRunnable, 10000);
    }

    private void cancelLoadWatchdog() {
        if (timeoutRunnable != null) {
            timeoutHandler.removeCallbacks(timeoutRunnable);
            timeoutRunnable = null;
        }
    }

    private String getServerUrl() {
        SharedPreferences prefs = getSharedPreferences(PREFS_NAME, Context.MODE_PRIVATE);
        return prefs.getString(KEY_SERVER_URL, getDefaultUrl());
    }

    private void saveServerUrl(String url) {
        if (!url.startsWith("http://") && !url.startsWith("https://")) {
            url = "https://" + url;
        }
        if (url.endsWith("/")) {
            url = url.substring(0, url.length() - 1);
        }
        SharedPreferences prefs = getSharedPreferences(PREFS_NAME, Context.MODE_PRIVATE);
        prefs.edit().putString(KEY_SERVER_URL, url).apply();
    }

    private void loadAppUrl() {
        String base = getServerUrl();
        String fullUrl = base + "/admin/mobile-uploader";

        Map<String, String> headers = new HashMap<>();
        headers.put("Bypass-Tunnel-Reminder", "true");
        headers.put("X-Requested-With", "PhemIndustrieApp");

        webView.loadUrl(fullUrl, headers);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (requestCode == FILE_CHOOSER_REQUEST) {
            if (fileUploadCallback != null) {
                Uri[] results = null;
                if (resultCode == Activity.RESULT_OK && data != null) {
                    String dataString = data.getDataString();
                    if (dataString != null) {
                        results = new Uri[]{Uri.parse(dataString)};
                    }
                }
                fileUploadCallback.onReceiveValue(results);
                fileUploadCallback = null;
            }
        }
    }

    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        if (keyCode == KeyEvent.KEYCODE_BACK) {
            if (settingsContainer.getVisibility() == View.VISIBLE) {
                settingsContainer.setVisibility(View.GONE);
                return true;
            }
            if (webView.canGoBack()) {
                webView.goBack();
                return true;
            }
        } else if (keyCode == KeyEvent.KEYCODE_MENU) {
            if (settingsContainer.getVisibility() == View.VISIBLE) {
                settingsContainer.setVisibility(View.GONE);
            } else {
                showSettingsOverlay("Menu Configuration Serveur");
            }
            return true;
        }
        return super.onKeyDown(keyCode, event);
    }
}
