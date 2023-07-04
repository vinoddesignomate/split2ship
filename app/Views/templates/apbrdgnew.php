</div>
<script src="https://unpkg.com/@shopify/app-bridge@3"></script>
<script>
    var AppBridge = window['app-bridge'];
    var actions = window['app-bridge'].actions;
    var createApp = AppBridge.default;

    const config = {
        apiKey: 'a47ead69b3d83a8042703f093f3cadb2',
        host: new URLSearchParams(location.search).get("host"),
        forceRedirect: true
    };
    const app = createApp(config);
</script>