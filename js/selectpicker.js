$( document ).ready(function() {

  if($("#selected_attestation").val() != "")
  {
    $("#"+$("#selected_attestation").val()).attr('selected', true);
    $('.selectpicker').selectpicker('refresh')
  }
  if($("#selected_region").val() != "")
  {
    $("#"+$("#selected_region").val()).attr('selected', true);
    $('.selectpicker').selectpicker('refresh')
  }
  if($("#selected_disponibilite").val() != "")
  {
    $("#"+$("#selected_disponibilite").val()).attr('selected', true);
    $('.selectpicker').selectpicker('refresh')
  }
  if($("#selected_statut").val() != "")
  { 
    statut = $("#selected_statut").val()
    for(i=0; i < JSON.parse(statut).length; i++)
    {
      var result = JSON.parse(statut)[i];   
      $("#"+result).attr('selected', true);
    }
    $('.selectpicker').selectpicker('refresh')
  }
});