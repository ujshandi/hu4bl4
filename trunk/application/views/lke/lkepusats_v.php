 
        
	<script  type="text/javascript" >
				var idLkepusat<?=$objectId;?>;
				var rowIndexDetail;

		$(function(){
			/* var wWidth = $(window).width();
			var wHeight = $(window).height();
			$("#dlg<?=$objectId;?>").css('width',wWidth);
			$("#dlg<?=$objectId;?>").css('height',wHeight); */
			
			
			
			var url;
			newData<?=$objectId;?> = function (){  
				var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
				if (row){
					if (row.has_child) {
						alert("Pilih data subkomponen terlebih dahulu");
						return false;
					}
					$('#dlg<?=$objectId;?>').dialog('open').dialog('setTitle','Add LKE Pusat');  
					$('#fm<?=$objectId;?>').form('clear');  
					
					url = base_url+'lke/lkepusat/save';  
					
					$("#deskripsi_komponen<?=$objectId?>").load(base_url+'lke/lkepusat/loadtreeup/'+row.komponen_id);
					//$("#lkepusat_id<?=$objectId?>").val(row.lkepusat_id);
					$("#id_komponen<?=$objectId?>").val(row.komponen_id);
					$("#lkepusat_id<?=$objectId?>").val("");
					
					
				}	
				else {
					alert("Pilih data subkomponen terlebih dahulu");
				}
				//addTab("Add PK Kementerian", "lke/lkepusat/add");
			}
			//end newData 
			
			editData<?=$objectId;?> = function (editmode){
				var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
				var tr = jQuery('#dg<?=$objectId;?>').closest('tr.datagrid-row');
				$('#saveBtn<?=$objectId;?>').css("display",(editmode)?"":"none");
				//alert('row index parent'+tr.attr('datagrid-row-index'));
				
				if ((idLkepusat<?=$objectId;?> ==null)||(idLkepusat<?=$objectId;?> =='undefined')) {						
					alert("Pilih data Checkpoint terlebih dahulu");
					return false;
				}
			//	$('#dg<?=$objectId;?>').datagrid('options').queryParams.
				//alert($.url().param("parentIndex")+"Parent");
				//if (row){
					$.ajax({
					url:'<?=base_url()?>lke/lkepusat/getDataEdit/'+idLkepusat<?=$objectId;?>,
					success:function(data){
						//alert(data);
						var data = eval('('+data+')');
							$('#dlg<?=$objectId;?>').dialog('open').dialog('setTitle','Edit LKE Pusat');  
						$('#fm<?=$objectId;?>').form('clear');  
						$('#files').empty();
						url = base_url+'lke/lkepusat/save';  
						
						$("#deskripsi_komponen<?=$objectId?>").load(base_url+'lke/lkepusat/loadtreeup/'+row.komponen_id);
						//$("#lkepusat_id<?=$objectId?>").val(row.lkepusat_id);
						$("#id_komponen<?=$objectId?>").val(row.komponen_id);
						$("#lkepusat_id<?=$objectId?>").val(row.lkepusat_id);
						$("#ref<?=$objectId?>").val(row.ref);
						
					}});
					
				//}	
			}
			//end editData
			
			
			
			clearFilter<?=$objectId;?> = function (){
				$("#filter_tahun<?=$objectId;?>").val('');
				searchData<?=$objectId;?>();
			}
			
			//tipe 1=grid, 2=pdf, 3=excel
			getUrl<?=$objectId;?> = function (tipe){
				var filtahun = $("#filter_tahun<?=$objectId;?>").val();
				
				if((filtahun==null)||(filtahun.length==0)) filtahun ="-1";
				
				if (tipe==1){
					return "<?=base_url()?>lke/lkepusat/tree/"+filtahun;
				}
				else if (tipe==2){
					return "<?=base_url()?>lke/lkepusat/pdf/"+filtahun;
				}else if (tipe==3){
					return "<?=base_url()?>lke/lkepusat/excel/"+filtahun;
				}
				
			}
			
			searchData<?=$objectId;?> = function (){
				//ambil nilai-nilai filter
				$('#dg<?=$objectId;?>').treegrid({
					url:getUrl<?=$objectId;?>(1),
				//	queryParams:{lastNo:'0'},	
				//	pageNumber : 1,
					onLoadSuccess:function(data){	
				//		$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						//prepareMerge<?=$objectId;?>(data);
				}});
			}
			//end searchData 		
		
			printData<?=$objectId;?>=function(){			
				//$.jqURL.loc(getUrl<?=$objectId;?>(2),{w:800,h:600,wintype:"_blank"});
			//window.open(getUrl<?=$objectId;?>(2));;
			alert("Sedang dalam pengerjaan");
		}
			toExcel<?=$objectId;?>=function(){
				alert("Sedang dalam pengerjaan");	
				//window.open(getUrl<?=$objectId;?>(3));;
			}
			
			saveData<?=$objectId;?>=function(){
				$('#fm<?=$objectId;?>').form('submit',{
					url: url,
					onSubmit: function(){
						return $(this).form('validate');
					},
					success: function(result){
						//alert(result);
						var result = eval('('+result+')');
						if (result.success){
							/* $.messager.show({
								title: 'Success',
								msg: result.msg
							}); */
							$('#dlg<?=$objectId;?>').dialog('close');		// close the dialog
							//$('#dg<?=$objectId;?>').datagrid('reload');	// reload the user data
							$('#ddv<?=$objectId;?>-'+rowIndexDetail).datagrid('reload');
						} else {
							$.messager.show({
								title: 'Error',
								msg: result.msg
							});
						}
					}
				});
			}
			//end saveData
			
			formatPrice=function (val,row){
				return val;//($.fn.autoNumeric.Format("txtAmount"+idx,total,{aSep:".",aDec:",",mDec:2}));
				/* if (val < 20){
					return '<span style="color:red;">('+val+')</span>';
				} else {
					return val;
				} */
			}

			setTimeout(function(){
				searchData<?=$objectId;?>();
				//$('#dg<?=$objectId;?>').datagrid({url:"<?=base_url()?>lke/lkepusat/grid"});
			},0);
			
			$("#popdesc<?=$objectId?>").click(function(){
				closePopup('#popdesc<?=$objectId?>');
			});
			$("#cmbPeriode<?=$objectId?>").change(function(){
					
			})
			
			
		 });
	</script>
	<style type="text/css">
		#fm<?=$objectId;?>{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			color:#666;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:80px;
		}
	  .fsearch{
		background:#fafafa;
		border-radius:5px;
		-moz-border-radius:0px;
		-webkit-border-radius: 5px;
		-moz-box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.2);
		-webkit-box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.2);
		filter: progid:DXImageTransform.Microsoft.Blur(pixelRadius=2,MakeShadow=false,ShadowOpacity=0.2);
		margin-bottom:10px;
		border: 1px solid #99BBE8;
	    color: #15428B;
	    font-size: 11px;
	    font-weight: bold;
	    position: relative;
	  }
	  .fsearch div{
		background:url('<?=base_url();?>public/css/themes/gray/images/panel_title.gif') repeat-x;
		height:200%;
		border-bottom: 1px solid #99BBE8;
		color:#15428B;
		font-size:10pt;
		text-transform:uppercase;
	    font-weight: bold;
	    padding: 5px;
	    position: relative;
	  }
	  .fsearch table{
	    padding: 15px;
	  }
	  .fsearch label{
		display:inline-block;
		width:60px;
	  }
		.fitemArea{
			margin-bottom:5px;
			text-align:left;
			/* border:1px solid blue; */
		}
		.fitemArea label{
			display:inline-block;
			width:84px;
			margin-bottom:5px;
		}
		
		.btn-primary.active,
			.btn-warning.active,
			.btn-danger.active,
			.btn-success.active,
			.btn-info.active,
			.btn-inverse.active {
			  color: rgba(255, 255, 255, 0.75);
			}
		.btn-primary:active,
		.btn-primary.active {
		  background-color: #003399 \9;
		}

		.btn-warning {
		  color: #ffffff;
		  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		  background-color: #faa732;
		  *background-color: #f89406;
		  background-image: -moz-linear-gradient(top, #fbb450, #f89406);
		  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fbb450), to(#f89406));
		  background-image: -webkit-linear-gradient(top, #fbb450, #f89406);
		  background-image: -o-linear-gradient(top, #fbb450, #f89406);
		  background-image: linear-gradient(to bottom, #fbb450, #f89406);
		  background-repeat: repeat-x;
		  border-color: #f89406 #f89406 #ad6704;
		  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffbb450', endColorstr='#fff89406', GradientType=0);
		  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
		}

		.btn-warning:hover,
		.btn-warning:focus,
		.btn-warning:active,
		.btn-warning.active,
		.btn-warning.disabled,
		.btn-warning[disabled] {
		  color: #ffffff;
		  background-color: #f89406;
		  *background-color: #df8505;
		}

		.btn-warning:active,
		.btn-warning.active {
		  background-color: #c67605 \9;
		}

		.btn-danger {
		  color: #ffffff;
		  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		  background-color: #da4f49;
		  *background-color: #bd362f;
		  background-image: -moz-linear-gradient(top, #ee5f5b, #bd362f);
		  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ee5f5b), to(#bd362f));
		  background-image: -webkit-linear-gradient(top, #ee5f5b, #bd362f);
		  background-image: -o-linear-gradient(top, #ee5f5b, #bd362f);
		  background-image: linear-gradient(to bottom, #ee5f5b, #bd362f);
		  background-repeat: repeat-x;
		  border-color: #bd362f #bd362f #802420;
		  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffee5f5b', endColorstr='#ffbd362f', GradientType=0);
		  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
		}

		.btn-danger:hover,
		.btn-danger:focus,
		.btn-danger:active,
		.btn-danger.active,
		.btn-danger.disabled,
		.btn-danger[disabled] {
		  color: #ffffff;
		  background-color: #bd362f;
		  *background-color: #a9302a;
		}

		.btn-danger:active,
		.btn-danger.active {
		  background-color: #942a25 \9;
		}

		.btn-success {
		  color: #ffffff;
		  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		  background-color: #5bb75b;
		  *background-color: #51a351;
		  background-image: -moz-linear-gradient(top, #62c462, #51a351);
		  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351));
		  background-image: -webkit-linear-gradient(top, #62c462, #51a351);
		  background-image: -o-linear-gradient(top, #62c462, #51a351);
		  background-image: linear-gradient(to bottom, #62c462, #51a351);
		  background-repeat: repeat-x;
		  border-color: #51a351 #51a351 #387038;
		  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462', endColorstr='#ff51a351', GradientType=0);
		  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
		}

		.btn-success:hover,
		.btn-success:focus,
		.btn-success:active,
		.btn-success.active,
		.btn-success.disabled,
		.btn-success[disabled] {
		  color: #ffffff;
		  background-color: #51a351;
		  *background-color: #499249;
		}

		.btn-success:active,
		.btn-success.active {
		  background-color: #408140 \9;
		}

		.btn-info {
		  color: #ffffff;
		  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		  background-color: #49afcd;
		  *background-color: #2f96b4;
		  background-image: -moz-linear-gradient(top, #5bc0de, #2f96b4);
		  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5bc0de), to(#2f96b4));
		  background-image: -webkit-linear-gradient(top, #5bc0de, #2f96b4);
		  background-image: -o-linear-gradient(top, #5bc0de, #2f96b4);
		  background-image: linear-gradient(to bottom, #5bc0de, #2f96b4);
		  background-repeat: repeat-x;
		  border-color: #2f96b4 #2f96b4 #1f6377;
		  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5bc0de', endColorstr='#ff2f96b4', GradientType=0);
		  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
		}

		.btn-info:hover,
		.btn-info:focus,
		.btn-info:active,
		.btn-info.active,
		.btn-info.disabled,
		.btn-info[disabled] {
		  color: #ffffff;
		  background-color: #2f96b4;
		  *background-color: #2a85a0;
		}

		.btn-info:active,
		.btn-info.active {
		  background-color: #24748c \9;
		}

		.btn-inverse {
		  color: #ffffff;
		  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		  background-color: #363636;
		  *background-color: #222222;
		  background-image: -moz-linear-gradient(top, #444444, #222222);
		  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#444444), to(#222222));
		  background-image: -webkit-linear-gradient(top, #444444, #222222);
		  background-image: -o-linear-gradient(top, #444444, #222222);
		  background-image: linear-gradient(to bottom, #444444, #222222);
		  background-repeat: repeat-x;
		  border-color: #222222 #222222 #000000;
		  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff444444', endColorstr='#ff222222', GradientType=0);
		  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
		}

		.btn-inverse:hover,
		.btn-inverse:focus,
		.btn-inverse:active,
		.btn-inverse.active,
		.btn-inverse.disabled,
		.btn-inverse[disabled] {
		  color: #ffffff;
		  background-color: #222222;
		  *background-color: #151515;
		}

		.btn-inverse:active,
		.btn-inverse.active {
		  background-color: #080808 \9;
		}
	
		.btn-primary {
		  background-color: #006DCC;
		  background-image: linear-gradient(to bottom, #0088CC, #0044CC);
		  background-repeat: repeat-x;
		  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		  color: #FFFFFF;
		  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		}

		.btn-success {
		  background-color: #5BB75B;
		  background-image: linear-gradient(to bottom, #62C462, #51A351);
		  background-repeat: repeat-x;
		  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		  color: #FFFFFF;
		  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		}

		.btn {
		  -moz-border-bottom-colors: none;
		  -moz-border-left-colors: none;
		  -moz-border-right-colors: none;
		  -moz-border-top-colors: none;
		  border-image: none;
		  border-radius: 4px 4px 4px 4px;
		  border-style: solid;
		  border-width: 1px;
		  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
		  cursor: pointer;
		  display: inline-block;
		  font-size: 12px;
		  line-height: 20px;
		  padding: 4px 12px;
		  text-align: center;
		  vertical-align: middle;
		}


		
	</style>
	
	<div id="tb<?=$objectId;?>" style="height:auto">
	   <table border="0" cellpadding="1" cellspacing="1" width="100%">
		<tr>
			<td>
			<div class="fsearch" <?=($this->session->userdata('unit_kerja_e1')=='-1'?'':'')?>>
				<table border="0" cellpadding="1" cellspacing="1">
				<tr>
					<td>Tahun :</td>
					<td>
					<?=$this->lkepusat_model->getListTahun($objectId)?>
					</td>
				</tr>
				<tr style="height:10px">
					  <td style="">
					  </td>
				</tr>
				<tr>
					<td align="right" colspan="2" valign="top">
						<a href="#" class="easyui-linkbutton" onclick="clearFilter<?=$objectId;?>();" iconCls="icon-reset">Reset</a>
						<a href="#" class="easyui-linkbutton" onclick="searchData<?=$objectId;?>();" iconCls="icon-search">Search</a>
					</td>
				</tr>
				</table>
			</div>
			</td>
		</tr>
		</table>
	  <div style="margin-bottom:5px">
	  
		<? if($this->sys_menu_model->cekAkses('ADD;',302,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="newData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>  
		<?}?>
	
		<!------------Edit View-->
		<? if($this->sys_menu_model->cekAkses('EDIT;',302,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="editData<?=$objectId;?>(true);" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Edit</a>
		<?}?>
		<? if($this->sys_menu_model->cekAkses('VIEW;',302,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="editData<?=$objectId;?>(false);" class="easyui-linkbutton" iconCls="icon-view" plain="true">View</a>
		<?}?>
		
		<!--
		<a href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
		<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
		-->
	  </div>
	</div>
	<!-- class="easyui-datagrid" -->
	<table id="dg<?=$objectId;?>"  style="height:auto;width:auto" class="easyui-treegrid" nowrap="false"
	 title="Data LKE Pusat" idField="id" treeField="nama_komponen" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="true" pagination="true">
	  <thead>
	  <tr>
		<th field="has_child" hidden="true" sortable="true" width="50px">has_child</th> 
		<th field="komponen_id" hidden="true" sortable="true" width="50px">komponen_id</th> 
		<th field="nama_komponen" sortable="true" width="150px" rowspan="2">Komponen/Sub Komponen</th>		
		<th sortable="true" width="30px" colspan="2">Unit Kerja</th>		
		<th field="ref" sortable="false" width="30px" rowspan="2">REF</th>
	  </tr>
	  <tr>
		<th field="index_mutu" sortable="false" align="center" width="20px">Y/T.</th>
		<th field="nilai" sortable="false" align="center"  width="20px">Nilai</th>		
	  </tr>
	  </thead>  
	</table>
	
	<!-- Area untuk Form Add/Edit >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
	
	<div id="dlg<?=$objectId;?>" class="easyui-dialog" style="width:720px;height:400px;padding:10px 20px" closed="true"  buttons="#dlg-buttons">
		<!----------------Edit title-->
		
		<form id="fm<?=$objectId;?>" method="post" >			
			<div class="fitem">
				
					<div id="deskripsi_komponen<?=$objectId?>" cols="70" class="easyui-validatebox" ></div>
				<input type="hidden" id="lkepusat_id<?=$objectId?>" name="lkepusat_id"/>
				<input type="hidden" id="id_komponen<?=$objectId?>" name="id_komponen"/>				
				
			</div>
			
			<div class="fitem">
				
				<hr>
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Tahun :</label>
				<input name="tahun" size="5" maxlength="4" id="tahun<?=$objectId?>" class="easyui-validatebox required">
			</div>
			
			
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Index</label>
				 <?=$indexmutu?>
			</div>
			
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Referensi :</label>
				<input name="ref" size="60" id="ref<?=$objectId?>" class="easyui-validatebox">
			</div>
			
			
		</form>
		<div id="dlg-buttons">
			<!----------------Edit title-->
			<a href="#" id="saveBtn<?=$objectId;?>" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveData<?=$objectId;?>()">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg<?=$objectId;?>').dialog('close')">Cancel</a>
		</div>
	</div>
	
	<script type="text/javascript">
        $(function(){
			var parentId;
			// chan
			$('#dg<?=$objectId;?>').datagrid({
				url:getUrl<?=$objectId;?>(1),	
				//view: detailview,
				queryParams:{rowIdx:'0'},	
				/*  detailFormatter:function(index,row){
                    return '<div style="padding:2px"><table id="ddv<?=$objectId;?>-' + index + '"></table></div>';
                //  return "tes";
                }, */
                onExpandRow: function(index,row){
				//	alert(row.lkepusat_id);
						
                    /* $('#ddv<?=$objectId;?>-'+index).datagrid({
                        url:'<?=base_url()?>lke/lkepusat/griddetail/'+row.lkepusat_id+'/?parentIndex='+index,
                        fitColumns:true,
                        singleSelect:true,
                        rownumbers:true,
                        loadMsg:'',
                        height:'auto',
                        columns:[[
                            {field:'lkepusat_id',title:'id',width:200,hidden:true},
                            {field:'unit_kerja',title:'Unit Kerja',width:200},
                            {field:'periode',title:'Periode',width:75},
                            {field:'kriteria',title:'Kriteria Capaian',width:200},
                            {field:'ukuran',title:'Ukuran Capaian',width:200},
                            {field:'target',title:'Target',width:100,align:'right'},
                            
                            
                            
                            {field:'keterangan',title:'Keterangan',width:200}
                            
                        ]],
                        onResize:function(){
                            $('#dg<?=$objectId;?>').datagrid('fixDetailRowHeight',index);
                        },
                       onClickCell:function(rowIndex, field, value){
							 $('#ddv<?=$objectId;?>-'+index).datagrid('selectRow', rowIndex);
							var row = $('#ddv<?=$objectId;?>-'+index).datagrid('getSelected');
							///alert(row);
							idLkepusat<?=$objectId;?> = row.lkepusat_id;
							rowIndexDetail = index;
							
					   },
                        onLoadSuccess:function(){
                            setTimeout(function(){
                                $('#dg<?=$objectId;?>').datagrid('fixDetailRowHeight',index);
                            },0);
                        }
                    }); */
                //    $('#dg<?=$objectId;?>').datagrid('fixDetailRowHeight',index);

	
                }
				//onClickCell: function(rowIndex, field, value){
/* 					$('#dg<?=$objectId;?>').datagrid('selectRow', rowIndex);
					
					var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
					idLkepusat<?=$objectId;?> = null;
 */					//alert(row.deskripsi_iku_kl);
					/* switch(field){
						case "kode_kl":
							showPopup('#popdesc<?=$objectId?>', row.nama_kl);
							break;
						case "kode_sasaran_kl":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_sasaran_kl);
							break;
						case "kode_iku_kl":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_iku_kl);
							break;						
						default:
							closePopup('#popdesc<?=$objectId?>');
							break;
					} */
				//}
			});
			
			
            //searchData<?=$objectId;?>();
        });
    </script>
    
     
 
	<div class="popdesc" id="popdesc<?=$objectId?>">pops</div>




 	   
 <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/js/jQuery-File-Upload-8.6.0/css/jquery.fileupload-ui.css" />     

<script type="text/javascript"  src="<?=base_url()?>public/js/jQuery-File-Upload-8.6.0/js/vendor/jquery.ui.widget.js"></script>
<script type="text/javascript"  src="<?=base_url()?>public/js/jQuery-File-Upload-8.6.0/js/vendor/load-image.min.js"></script>
<script type="text/javascript"  src="<?=base_url()?>public/js/jQuery-File-Upload-8.6.0/js/vendor/tmpl.min.js"></script>
<script type="text/javascript"  src="<?=base_url()?>public/js/jQuery-File-Upload-8.6.0/js/jquery.iframe-transport.js"></script>

<script  type="text/javascript" src="<?=base_url()?>public/js/jQuery-File-Upload-8.6.0/js/jquery.fileupload.js" ></script>

<script src="<?=base_url()?>public/js/jQuery-File-Upload-8.6.0/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?=base_url()?>public/js/jQuery-File-Upload-8.6.0/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin 
<script src="<?=base_url()?>public/js/jQuery-File-Upload-8.6.0/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin
<script src="<?=base_url()?>public/js/jQuery-File-Upload-8.6.0/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?=base_url()?>public/js/jQuery-File-Upload-8.6.0/js/jquery.fileupload-validate.js"></script>


<script type="text/javascript" >
/*jslint unparam: true */
/*global window, $ */
	//prepare upload
	




</script>
