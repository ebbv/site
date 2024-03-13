<!doctype html>
<html>
<head>
</head>
<body>

<div id="adobe-dc-view"></div>
<script src="https://acrobatservices.adobe.com/view-sdk/viewer.js"></script>
<script type="text/javascript">
  document.addEventListener("adobe_dc_view_sdk.ready", function(){
    var adobeDCView = new AdobeDC.View({clientId: "<aed2d2b7594a428f9df59868eb1c50d4>", divId: "adobe-dc-view"});
    adobeDCView.previewFile({
      content:{location: {url: "déroulement.pdf"}},
      metaData:{fileName: "Déroulement"}
    }, {showAnnotationTools: false});
  });
</script>

</body>
</html>