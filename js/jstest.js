function generatePDF() {
 var doc = new jsPDF();
  doc.fromHTML(document.getElementById("test"),
  15,
  15, 
  {
    'width': 170
  },
  function(a) 
   {
    doc.save("Orderdetail.pdf");
  });
}