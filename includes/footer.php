         <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     
    <script
      src="https://kit.fontawesome.com/74d27f6c08.js"
      crossorigin="anonymous"
    ></script>


    </body>
</html>
<!-- <script>
$(document).ready(function(){
 
 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   dataType:"json",
   success:function(data)
   {
    $('#total_records').text(data.length);
    var html = '';
    if(data.length > 0)
    {
     for(var count = 0; count < data.length; count++)
     {
      html += '<tr>';
      html += '<td>'+data[count].CustomerName+'</td>';
      html += '<td>'+data[count].Gender+'</td>';
      html += '<td>'+data[count].Address+'</td>';
      html += '<td>'+data[count].City+'</td>';
      html += '<td>'+data[count].PostalCode+'</td>';
      html += '<td>'+data[count].Country+'</td></tr>';
     }
    }
    else
    {
     html = '<tr><td colspan="5">No Data Found</td></tr>';
    }
    $('tbody').html(html);
   }
  })
 }

 $('#search').click(function(){
  var query = $('#tags').val();
  load_data(query);
 });

});
</script> -->