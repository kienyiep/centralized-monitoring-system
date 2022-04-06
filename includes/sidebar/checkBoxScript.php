<script>
$(document).ready(function(){
    $("#form1 #select-all").click(function(){
       $("#form1 input[name='checklist[]']").prop('checked', this.checked);
    });
});


</script>   

<script>

$(document).ready(function(){
    $("#form1 #select-all2").click(function(){
       $("#form1 input[name='checklicense[]']").prop('checked', this.checked);
    });
});

</script>