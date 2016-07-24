$(document).ready(function(){
    document.getElementById("date").disabled=true;
    $('#show-detail').hide();
    $('#found').hide();
    $('#notfound').hide();
    $('label#employee-name').hide();
    $('#employee_id').focus();
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    document.getElementById("p-id").disabled=true;
    document.getElementById("emp-name").disabled=true;
    document.getElementById("employee_id").disabled=true;

    $('input[name="patientType"]').change(function(){
        var type=$(this).val();
        if(type == 'inPatient') {
            //alert('inpatient');
            document.getElementById("emp-name").disabled=true;
            
            document.getElementById("employee_id").disabled=false;
            $('#employee_id').val('');
            
            $('#employee_id').focus();
            $('#show-detail').hide();
            $('#found').hide();
            $('#notfound').hide();
            
        } else if(type=='outPatient') {
            document.getElementById("employee_id").disabled=true;
            $('#employee_id').val('0000');
            $('#emp-name').val('');
            
            document.getElementById("emp-name").disabled=false;
            $('#emp-name').focus();
            $('#show-detail').hide();
            $('#found').hide();
            $('#notfound').hide();
        }
    });
    
    $('#employee_id').keyup(function () {
        if($('#employee_id').val())
        {
            $.ajax({
                url: "service/act-prescription.php",
                type: "POST",
                data: {
                    action: 'checkEmp',
                    eid: $('input#employee_id').val()
                },
                //dataType: "json",
                success: function(result){
                    $NAME=result;
                    if(result!=0) {
                        $('#show-detail').show();
                        $('#found').show();
                        $('#notfound').hide();
                        $('#emp-name').val($NAME);
                    }
                    else {
                        $('#show-detail').show();
                        $('#found').hide();
                        $('#notfound').show();
                        $('#emp-name').val('');
                    }
                }
            });
        }
    });
    
    
    /** prescription auro complete **/
    var i=$('#addedDrugs .displayNamez').length;
    var isSelected = false;
    $('input#search_box').autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "service/act-prescription.php",
                type: "POST",
                data: {
                    action:'getSuggest',
                    searchText:request.term
                },
                dataType: "json",
                cache: false,
                success: function( data ) {
                    response( $.map( data['0'], function( Convalue ) {
                        return {
                            label: Convalue['name'],
                            value: Convalue['drugs_name'],
                            id: Convalue['ID'],
                            priceID: Convalue['drugs_price'],
                            catId: Convalue['drugs_cat_id'],
                            drugsTotal: Convalue['drugs_quantity']
                        }
                    }));
                },
                error: function (e,a,b) {
                    Lobibox.alert("error",
                    {
                        msg: 'error in searching drugs'
                    });
                }
            });
        },
        //autoFocus: true,
        maxCacheLength: 0,
        minLength: 1,
        select: function( event, ui ) {
            event.preventDefault();
            isSelected = true;
            $('input#search_box').val('');
            if(ui.item)
            {
                //var unitPrice=ui.item.priceID;
                AddFields(ui.item.value, ui.item.id, ui.item.priceID, ui.item.catId, ui.item.drugsTotal);
            }
            else {
                Lobibox.alert("info",
                {
                    msg: "Nothing selected, input was " + this.value
                });
            }
        }
    });
	
    /*highlight auto-complete*/
    String.prototype.replaceAt = function(index, char) {
        return this.substr(0, index) + "<span style='font-weight:bold; color:#0cc;'>" + char + "</span>";
    }
	
    $.ui.autocomplete.prototype._renderItem = function(ul, item) {
        this.term = this.term.toLowerCase();
        var resultStr = item.label.toLowerCase();
        var t = "";
        while (resultStr.indexOf(this.term) != -1) {
            var index = resultStr.indexOf(this.term);
            t = t + item.label.replaceAt(index, item.label.slice(index, index + this.term.length));
            resultStr = resultStr.substr(index + this.term.length);
            item.label = item.label.substr(index + this.term.length);
        }
        return $("<li></li>").data("item.autocomplete", item).append("<a>" + t + item.label + "</a>").appendTo(ul);
    };
    
    /*capitalize in js*/
    String.prototype.capitalize = function() {
        return this.replace(/(?:^|\s)\S/g, function(a) {
            return a.toUpperCase();
        });
    };
    
    function AddFields(drugValue, drugId, drugPrice, categoryId, drugsTotal)
    {
        var rowDrugAdd=addIDs(drugValue, drugId, drugPrice, categoryId, drugsTotal, i);
        if(rowDrugAdd=='done') {
            $('#row5').show();
        }
        if(rowDrugAdd=='duplicate')
        {
            Lobibox.alert("error",
            {
                msg: drugValue+' already in your prescription.'
            });
        }
        i=i+1;
    }
    
    function addIDs(drugValue, drugId, drugPrice, categoryId, drugsTotal, i)
    {
        var duplicateHerb=1;
        drugPrice = Number(drugPrice).toFixed(2);
        
        for(var z=0; z <(i+1); z++)
        {
            //alert(drugId+' '+$('#addedDrugs div#Added'+z+' #drugs_id').val());
            if(drugId == $('#addedDrugs div#Added'+z+' #drugs_id').val())
            {
                duplicateHerb=1;
                $('#search_box').val('');
                $('#search_box').focus();
                return 'duplicate';
            }
            else {
                duplicateHerb=0;
            }
        }
    
        if(duplicateHerb==0)
        {
            var strAdd='<div class="row row-item displayNamez" id="Added'+i+'">'+
            //'<div class="col-md-1 text-center slno col-mod">('+ Number(i+1) +')</div>'+
            '<div class="col-md-4 col-mod">'+
            '<input id="drugs_name" name="drugs_name" placeholder="Name" readonly class="form-control input-group" type="text" value="'+drugValue+'"/>'+
            '<input id="drugs_id" name="drugs_id[]" readonly class="form-control input-group" type="hidden" value="'+drugId+'" />'+
            '<input id="drugCatId" name="drugCatId[]" readonly class="form-control input-group" type="hidden" value="'+categoryId+'" />'+
            '<input id="drugsTotalQ" name="drugsTotalQ[]" readonly class="form-control input-group" type="hidden" value="'+drugsTotal+'" />'+
            '</div>'+
            '<div class="col-md-2 col-mod">'+
            '<input id="addedQuantity" name="addedQuantity[]" placeholder="Quantity" class="form-control input-group" type="text" value="1"/>'+
            '</div>'+
            '<div class="col-md-2 col-mod">'+
            '<input id="drugs_Price" name="drugs_Price" placeholder="Price" readonly class="form-control input-group" type="text" value="'+drugPrice+'"/>'+
            '</div>'+
            '<div class="col-md-2 col-mod">'+
            '<input id="drugs_total" name="drugs_total[]" placeholder="Total" readonly class="form-control input-group" type="text" value="'+drugPrice+'"/>'+
            '</div>'+
            '<div class="col-md-2 col-mod">'+
            '<button type="button" class="btn btn-block btn-primary" id="txtDel">'+
            '<span class="fa fa-trash-o"></span> Remove'+
            '</button>'+
            '</div>'+
            '</div>';
                        
            $('#addedDrugs').append(strAdd);
            
            $('#search_box').val('');
            $('#search_box').focus();
            return 'done';
        }
	    
    } //end function addIdz
    
    /** delete drug from presc. **/
    $('#addedDrugs').on('click','#txtDel',function() {
	
        var id = $(this).parents('.displayNamez').attr('id');
        Lobibox.confirm({
            msg: "Click Yes to confirm delete?",
            callback: function ($this, type, ev) {
                if (type == 'yes') {
                    $('#'+id).remove();
						
                    if($('#addedDrugs .displayNamez').length <= 1)
                    {
                        $('#row5').hide();
                    }
                }
            }
        });
    });
    
    $('#addedDrugs').on('keyup', '#addedQuantity', function () {
        if (!this.value.match(/^([0-9]{0,3})$/)) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0,3);                        
        }
        
        $(this).parent().parent().find('#drugs_total').val(Number($(this).parent().parent().find('#drugs_Price').val() * this.value).toFixed(2));
        
        var maxQuantity = $(this).parent().parent().find('#drugsTotalQ').val();
        
        if(Number(this.value) > Number(maxQuantity))
        {
            Lobibox.alert("error",
            {
                msg: 'It has only '+ maxQuantity +' left in stock. Please enter less than that.'
            });
            
            $(this).parent().parent().find('#addedQuantity').val(maxQuantity);
            $(this).parent().parent().find('#drugs_total').val(Number($(this).parent().parent().find('#drugs_Price').val() * maxQuantity).toFixed(2));
        }
    });
    
    /** save pres. in DB **/
    $('#btnAddPrescription').on('click', function() {
        
        $('#action').val("addPres");
        
        if($('#Customprescription #doctor_id').val()=='' || $('#Customprescription #doctor_id').val()==null) {
            Lobibox.alert("error",
            {
                msg: 'Please Select a Doctor'
            });
        }
        else if($('#Customprescription input[name="patientType"]').val()=='' || $('#Customprescription input[name="patientType"]').val()==null) {
            Lobibox.alert("error",
            {
                msg: 'Please select Patient type'
            });
        }
        else if($('#Customprescription #employee_id').val()=='' || $('#Customprescription #employee_id').val()==null) {
            Lobibox.alert("error",
            {
                msg: 'Please enter employee id'
            });
        }
        else if($('#Customprescription #emp-name').val()=='' || $('#Customprescription #emp-name').val()==null) {
            Lobibox.alert("error",
            {
                msg: 'Please enter employee name'
            });
        }
        else if($('#addedDrugs .displayNamez').length < 1) {
            Lobibox.alert("error",
            {
                msg: 'Please enter minimum 1 drug in Prescription'
            });
        }
        else if($('#Customprescription #p_remark').val()=='' || $('#Customprescription #p_remark').val()==null) {
            Lobibox.alert("error",
            {
                msg: 'Please enter remark'
            });
        }
        else if($('#Customprescription #p_note').val()=='' || $('#Customprescription #p_note').val()==null) {
            Lobibox.alert("error",
            {
                msg: 'Please enter note'
            });
        }
        else {
            document.getElementById("employee_id").disabled=false;
            document.getElementById("employee_id").readonly=true;
            document.getElementById("emp-name").disabled=false;
            document.getElementById("emp-name").readonly=true;
            
            $.ajax({
                url: "service/act-prescription.php",
                type: "POST",
                data: $('#Customprescription').serialize(),
                //dataType: "json",
                success: function(result){
                if(result=='done')
                    {
                        Lobibox.alert("success",
                        {
                            msg: 'Prescription successfully added !!',
                            callback: function ($this, type, ev) {
                                location.reload();
                            }
                        });
                    }
                    else {
                        Lobibox.alert("error",
                        {
                            msg: result
                        });
                    }
                },
                error: function (a,b,c) {
                    Lobibox.alert("error",
                    {
                        msg: 'error in Adding Prescription'
                    });
                }
            });
        }
    });
});