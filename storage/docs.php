<div class="wrap">

    <h1>API Docs</h1>

    <div id="swagger-ui"></div>

</div>

<link
    rel="stylesheet"
    href="<?= WP_REST_API_PLUGIN_URL ?>storage/swagger-ui/swagger-ui.css"
>

<style>

#swagger-ui {
    margin-top: 20px;
}

</style>

<script
    src="<?= WP_REST_API_PLUGIN_URL ?>storage/swagger-ui/swagger-ui-bundle.js">
</script>

<script
    src="<?= WP_REST_API_PLUGIN_URL ?>storage/swagger-ui/swagger-ui-standalone-preset.js">
</script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    SwaggerUIBundle({

        url: "<?= WP_REST_API_PLUGIN_URL ?>storage/openapi.json",

        dom_id: '#swagger-ui',

        deepLinking: true,

        presets: [
            SwaggerUIBundle.presets.apis,
            SwaggerUIStandalonePreset
        ],

        layout: "BaseLayout"

    });

});

</script>