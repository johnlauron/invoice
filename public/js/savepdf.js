$(document).ready(function(){
    $('#pdf').click(function() {
        html2canvas(document.getElementById("pdf_print"), {
          dpi: 1200, // Set to 300 DPI
          scale: 3, // Adjusts your resolution
          onrendered: function(canvas) {
            var img = canvas.toDataURL("image/jpeg", 1);
            var doc = new jsPDF('L', 'px');
            doc.addImage(img, 'JPEG', 0, 0,);
            doc.save('sample-file.pdf');
          }
        });
      });
    $("#print").click(function () {
        //Hide all other elements other than printarea.
        $("#to_print").show();
        window.print();
    });
});