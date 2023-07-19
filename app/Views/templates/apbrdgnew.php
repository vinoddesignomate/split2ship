</div>
<script src="https://unpkg.com/@shopify/app-bridge@3"></script>
<?php
if(isset($pricurl)){
    $prcurldur = $pricurl; 
}else {
    $prcurldur = ""; 
}
?>
<script>
    var AppBridge = window['app-bridge'];
    var actions = window['app-bridge'].actions;
    var createApp = AppBridge.default;
    var redircur = '<?php echo $prcurldur;?>';
    var Redirect = actions.Redirect;
    const config = {
        apiKey: 'a47ead69b3d83a8042703f093f3cadb2',
        host: new URLSearchParams(location.search).get("host"),
        forceRedirect: true
    };
    const app = createApp(config);
    const redirect = Redirect.create(app);
    redirect.dispatch(Redirect.Action.REMOTE, redircur);
</script>