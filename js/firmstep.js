$(document).ready(function(){
    $('#frmCustomer').submit(function(e){
        if(frmCustomerValidate()){
            $.post(
                "save.php",
                $(this).serialize(),
                function(data){
                    if($('#trNoRecord'))
                        $('#trNoRecord').remove();

                    var rowNum = $('#tblQueue tbody tr').length + 1;
                    data = data.replace("{{rowNumber}}", rowNum);
                    $('#tblQueue').append(data);
                    showMessage();
                    document.getElementById('frmCustomer').reset();
                });
        }
        e.preventDefault();
    })

    $('#frmLogin').submit(function(e){
        if(!frmLoginValidate())
            return false;
        else
            return true;
    })
});

function frmLoginValidate(){
    var blnValid = true;

    if(!$.trim($('#txtUsername').val())){
        $('#divLoginnameError').show();
        blnValid = false;
    }
    else
        $('#divLoginnameError').hide();

    if(!$.trim($('#txtPassword').val())){
        $('#divPasswordError').show();
        blnValid = false;
    }
    else
        $('#divPasswordError').hide();

    return blnValid;
}

function frmCustomerValidate(){
    var blnValid = true;

    if($('input[name="rdbtnService"]:checked').length == 0){
        $('#divServicesError').show();
        blnValid = false;
    }
    else
        $('#divServicesError').hide();
    
    if($('input[name="rdbtnType"]:checked').length == 0){
        $('#divCustomerTypeError').show();
        blnValid = false;
    }
    else{
        $('#divCustomerTypeError').hide();
        var selectedCustomerType = $('input[name="rdbtnType"]:checked').val();
        if(selectedCustomerType == 1){
            if($('#cmbTitle').val() == '-'){
                $('#divTitleError').show();
                blnValid = false;
            }
            else
                $('#divTitleError').hide();
            
            if(!$.trim($('#txtFirstname').val())){
                $('#divFirstnameError').show();
                blnValid = false;
            }
            else
                $('#divFirstnameError').hide();

            if(!$.trim($('#txtLastname').val())){
                $('#divLastnameError').show();
                blnValid = false;
            }
            else
                $('#divLastnameError').hide();
        }
        else if(selectedCustomerType == 2){
            if(!$.trim($('#txtOrganisationName').val())){
                $('#divOrganisationNameError').show();
                blnValid = false;
            }
            else
                $('#divOrganisationNameError').hide();
        }
    }

    return blnValid;
}

function showMessage(){
    var divMessage = $("#divMessage")
    divMessage.addClass("show");
    setTimeout(function(){
        divMessage.removeClass("show");
    }, 3000);
}