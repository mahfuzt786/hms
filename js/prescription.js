$(document).ready(function(){
    document.getElementById("date").disabled=true;
    $('#show-detail').hide();
    $('#found').hide();
    $('#notfound').hide();
    $('label#employee-name').hide();
    $('#emp-id').focus();
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    document.getElementById("emp-name").disabled=true;
    document.getElementById("emp-id").disabled=true; 

    $('input[name="patientType"]').change(function(){
        var type=$(this).val();
        if(type == 'inPatient') {
            //alert('inpatient');
            document.getElementById("emp-name").disabled=true;
            
            document.getElementById("emp-id").disabled=false;
            $('#emp-id').val('');
            
            $('#emp-id').focus();
            $('#show-detail').hide();
            $('#found').hide();
            $('#notfound').hide();
            
        } else if(type=='outPatient') {
            document.getElementById("emp-id").disabled=true;
            $('#emp-id').val('0000');
            $('#emp-name').val('');
            
            document.getElementById("emp-name").disabled=false;
            $('#emp-name').focus();
            $('#show-detail').hide();
            $('#found').hide();
            $('#notfound').hide();
        }
    });
    
    $('#emp-id').keyup(function () {
        if($('#emp-id').val())
        {
            $.ajax({
                url: "service/act-prescription.php",
                type: "POST",
                data: {
                    action: 'checkEmp',
                    eid: $('input#emp-id').val()
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
                            catId: Convalue['drugs_cat_id']
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
                AddFields(ui.item.value, ui.item.id, ui.item.priceID, ui.item.catId);
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
    
    $('#GramsQuan').on('keyup',function () {
        if (!this.value.match(/^([0-9]{0,9})$/)) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0,9);                        
        }
    });
    
    function AddFields(drugValue, drugId, drugPrice, categoryId)
    {
        var rowDrugAdd=addIDs(drugValue, drugId, drugPrice, categoryId, i);
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
    
    function addIDs(drugValue, drugId, drugPrice, categoryId, i)
    {
        var duplicateHerb=1;
        
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
            '<input id="drugs_name" name="drugs_name" placeholder="Name" readonly class="form-control input-group" type="text"/>'+
            '<input id="drugs_id" name="drugs_id[]" readonly class="form-control input-group" type="hidden" />'+
            '<input id="drugs_cat" name="drugs_cat[]" readonly class="form-control input-group" type="hidden" />'+
            '</div>'+
            '<div class="col-md-2 col-mod">'+
            '<input id="addedQuantity" name="addedQuantity[]" placeholder="Quantity" class="form-control input-group" type="text"/>'+
            '</div>'+
            '<div class="col-md-2 col-mod">'+
            '<input id="drugs_Price" name="drugs_Price" placeholder="Price" readonly class="form-control input-group" type="text"/>'+
            '</div>'+
            '<div class="col-md-2 col-mod">'+
            '<input id="drugs_total" name="drugs_total[]" placeholder="Total" readonly class="form-control input-group" type="text"/>'+
            '</div>'+
            '<div class="col-md-2 col-mod">'+
            '<button type="button" class="btn btn-block btn-primary" id="txtDel">'+
            '<span class="fa fa-trash-o"></span> Remove'+
            '</button>'+
            '</div>'+
            '</div>';
                        
            $('#addedDrugs').append(strAdd);
            
            $("#Added"+i+" #drugs_name").val(drugValue);
            $("#Added"+i+" #drugs_id").val(drugId);
            $("#Added"+i+" #drugs_cat").val(categoryId);
            $("#Added"+i+" #drugs_Price").val(drugPrice);
            $("#Added"+i+" #addedQuantity").val('1');
            $("#Added"+i+" #drugs_total").val(drugPrice);
            
            
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
    
    /** save pres. in DB **/
    $('#btnAddPrescription').on('click', function(e) {
        e.preventDefault();
        
        alert('working..');
    });
});