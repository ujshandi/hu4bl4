<script  type="text/javascript" src="<?=base_url()?>public/js/autoNumeric.js"></script>
	<script  type="text/javascript" >
				
		$(function(){
			$('.year').autoNumeric('init',{aSep: '', aDec: ',',vMin:'0',aPad:"false",vMax:"9999"});
		 	saveData<?=$objectId;?>=function(){
			
				$('#fm<?=$objectId;?>').form('submit',{
					url: base_url + 'kka/pre_usulan1_e1/save',
					onSubmit: function(){
						return $(this).form('validate');
					},
					success: function(result){
						//alert(result);
						var result = eval('('+result+')');
						if (result.success){
							$.messager.show({
								title: 'Success',
								msg: 'Data Berhasil Disimpan'
							});
							
							// delete all row
							// try {
								// var table = document.getElementById('tbl<?=$objectId;?>');
								// var rowCount = table.rows.length;
								// var i=0;
								
								// for(i=rowCount-1; i>1; i--){
									// table.deleteRow(i);
								// }
								
							// }catch(e) {
								// alert(e);
							// }
							
							// reload and close tab
							$('#dg<?=$objectId;?>').datagrid('reload');
							$('#tt').tabs('close', 'Add Pra Usulan 1 Eselon I');
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
			
			//chan=================================
			
			$("#tahun<?=$objectId;?>").change(function(){
				var e1 = $("#kode_e1<?=$objectId;?>").val();
				 setSasaranE1<?=$objectId;?>(e1,$(this).val());
				setIkuE1<?=$objectId;?>(e1,$(this).val());
				setKegiatanE1<?=$objectId;?>(e1,$(this).val());
			});
			
			setKegiatanE1<?=$objectId?> = function(e1,tahun){
				<? if ($this->session->userdata('unit_kerja_e1')!='-1') {?>
				 e1 = '<?=$this->session->userdata('unit_kerja_e1');?>';
				<?}?>
				
				tahun =  $('#tahun<?=$objectId;?>').val();
				$("#tbodykegiatan<?=$objectId;?>").load(
					base_url+"kka/pre_usulan1_e1/getKegiatan_e1/"+e1+"/"+tahun,
					function(){
						$('.money').autoNumeric('init',{aSep: '.', aDec: ',',vMin:'0',aPad:"false",vMax:"999999999999999"});
					}
				);
			}
			
			
			setSasaranE1<?=$objectId;?> = function(e1, tahun){
				<? if ($this->session->userdata('unit_kerja_e1')!='-1') {?>
				 e1 = '<?=$this->session->userdata('unit_kerja_e1');?>';
				<?}?>
				
				tahun =  $('#tahun<?=$objectId;?>').val();
				$("#divSasaranE1<?=$objectId?>").load(
					base_url+"kka/pre_usulan1_e1/getListSasaranE1/"+"<?=$objectId;?>"+"/"+e1+"/"+tahun,
					function(){
						$('textarea').autosize();  
						if($("#drop<?=$objectId;?>").is(":visible")){
							$("#drop<?=$objectId;?>").slideUp("slow");
						}
						
						$("#txtkode_sasaran_e1<?=$objectId;?>").click(function(){
							$("#drop<?=$objectId;?>").slideDown("slow");
						});
						
						$("#drop<?=$objectId;?> li").click(function(e){
							var chose = $(this).text();
							//alert(chose);
							$("#txtkode_sasaran_e1<?=$objectId;?>").text(chose);
							$("#drop<?=$objectId;?>").slideUp("slow");
						});
					//	
					//	if (key!=null)
						//	$('#kode_sasaran_e2<?=$objectId;?>').val(key);
						
						//if ((val!=null)&&(val!=""))
							//$('#txtkode_sasaran_e1<?=$objectId;?>').val(val);
							
					}
				);
				//alert("here");
				
			}
			
			setIkuE1<?=$objectId;?> = function(e1, tahun){
				<? if ($this->session->userdata('unit_kerja_e1')!='-1') {?>
				 e1 = '<?=$this->session->userdata('unit_kerja_e1');?>';
				<?}?>
				
				tahun =  $('#tahun<?=$objectId;?>').val();
				$("#divIkuE1<?=$objectId?>").load(
					base_url+"kka/pre_usulan1_e1/getListIkuE1/"+"<?=$objectId;?>"+"/"+e1+"/"+tahun,
					function(){
						$('textarea').autosize();  
						if($("#dropIku<?=$objectId;?>").is(":visible")){
							$("#dropIku<?=$objectId;?>").slideUp("slow");
						}
						
						$("#txtkode_iku_e1<?=$objectId;?>").click(function(){
							$("#dropIku<?=$objectId;?>").slideDown("slow");
						});
						
						$("#dropIku<?=$objectId;?> li").click(function(e){
							var chose = $(this).text();
							//alert(chose);
							$("#txtkode_iku_e1<?=$objectId;?>").text(chose);
							$("#dropIku<?=$objectId;?>").slideUp("slow");
						});
					//	
					//	if (key!=null)
						//	$('#kode_sasaran_e2<?=$objectId;?>').val(key);
						
						//if ((val!=null)&&(val!=""))
							//$('#txtkode_sasaran_e1<?=$objectId;?>').val(val);
							
					}
				);
				//alert("here");
				
			}
			
			
			$("#kode_e1<?=$objectId?>").change(function(){
				setSasaranE1<?=$objectId;?>($(this).val(), $('#tahun<?=$objectId;?>').val());
			});
			
			//inisilaisasi;
			setSasaranE1<?=$objectId;?>($("#kode_e1<?=$objectId?>").val(), $('#tahun<?=$objectId;?>').val());
			
			//--------------------
		});

	</script>
	
	<!-- Dari Stef -->
	<script type="text/javascript">		
		//chan-----------
		function setSasaran<?=$objectId;?>(valu){			
			if(valu != null){
				document.getElementById('kode_sasaran_e1<?=$objectId;?>').value = valu;
			}			
		}
		//chan-----------
		function setIku<?=$objectId;?>(valu){			
			if(valu != null){
				document.getElementById('kode_iku_e1<?=$objectId;?>').value = valu;
			}						
		}			
	</script>
	
	<style type="text/css">
		
		#tbl<?=$objectId;?> {
			width: 100%;
			padding: 0;
			margin: 0;
		}
		
		#tbl<?=$objectId;?> th{
			font: normal 11px;
			color: #4f6b72;
			border-right: 1px solid #C1DAD7;
			border-bottom: 1px solid #C1DAD7;
			border-top: 1px solid #C1DAD7;
			border-left: 1px solid #C1DAD7;
			text-align: left;
			padding: 2px 2px 3px 4px;
			margin:0;
			background: #CAE8EA url(<?=base_url();?>public/images/th.png) repeat-x;
		}
		
		#tbl<?=$objectId;?> td{
			border-right: 1px solid #C1DAD7;
			border-left: 1px solid #C1DAD7;
			border-top: 1px solid #C1DAD7;
			border-bottom: 1px solid #C1DAD7;
			background: #fff;
			padding: 0px 3px 0px 3px;
			margin:0;
			color: #4f6b72;
		}
		
		#tbl<?=$objectId;?> tr{
			margin:0;
		}
		
	 #fm<?=$objectId;?>{margin:0;padding:5px}
	  .ftitle{font-size:14px;font-weight:bold;color:#666;padding:5px 0;margin-bottom:10px;border-bottom:1px solid #ccc;}
	  .fitem{margin-bottom:3px;border:0px solid none;}
	  .fitem label{display:inline-block;/* border:1px solid gray; */width:65px; float:left;}
	  .fitemL{margin-bottom:5px;border:0px solid none;}
	  .fitemL label{display:inline-block;/* border:1px solid gray; */width:75px;}
	  .fitemLn{margin-bottom:5px;border:0px solid none;}
	  .fitemLn label{display:inline-block;/* border:1px solid gray; */width:55px;}
	  .fitemG{margin-bottom:5px;border:0px solid none;}
	  .fitemG label{display:inline-block;/* border:1px solid gray; */width:76px;}
	  .fitemleft{margin-bottom:5px;border:0px solid none;float:left;width:215px;}
	  .fitemleft label{display:inline-block;/* border:1px solid gray; */width:75px;}
	  .fitemTl{margin-bottom:5px;border:0px solid none;float:left;width:446px;}
	  .fitemTl label{display:inline-block;/* border:1px solid gray; */width:75px;}
	  .regT{padding:5px;line-height:15px;color:#15428b;font-weight:bold;font-size:12px;background:url('<?=base_url();?>public/css/themes/gray/images/panel_title.gif') repeat-x;position:relative;border:1px solid #99BBE8;width:100%;}
	  .regT-grid{padding:5px;line-height:15px;font-size:12px;position:relative;/* border:1px solid #99BBE8;background-color:#EFEFEF; */width:100%;height:100%;}
	  .fitemArea{margin-bottom:5px;text-align:left;border:0px solid none;}
	  .fitemArea label{display:inline-block;width:79px;margin-bottom:5px;}
	  .tabIDP {height:100%;width:615px;/* border:1px solid red; */float:left;}
	  .tabBound{height:100%;width:10px;/* border:1px solid red; */float:left;}
	  .tabPend{height:100%;width:200px;/* border:1px solid red; */float:left;}
	  .tabDP{height:100%;width:200px;/* border:1px solid red; */float:left;}
	  legend {font-size:10pt;color:gray;text-transform:uppercase;font-weight:bold;padding:8px;}
	  .displayReg {/*width:98.9%;height:600px;border:1px solid red;*/}
	  	  
	  /* 2ndstyle */	  
	  .table {padding:2px;}
	  .top {background-color:#cfddcc;}
	  .subTop {background-color:#f1f1f1;}
	  .gridHead {color:#fff;background-color:#333;border:1px solid #f1f1f1;text-align:center;}
	  .grid {background-color:#fff;border:1px solid #f1f1f1;padding:0 0 0 2px;}
	  .td1 {text-align:right;padding:1px;}
	  .td2 {text-align:center;padding:1px;width:10px;}
	  .td3 {text-align:left;width:10px;}
	  
	</style>
			
			<div class="easyui-layout" fit="true">  
								
				<div region="center" border="true" title="Tambah Data Pra Usulan 1 Eselon I">
				<form id="fm<?=$objectId;?>" method="post" style="margin:10px 5px 5px 10px;" onsubmit="return false">
					<div class="fitem">
						<label style="width:120px;vertical-align:top">Tahun :</label>
						<input id="tahun<?=$objectId?>" name="tahun" class="easyui-validatebox year" required="true" size="5" maxlength="4">
					</div>
					<div class="fitem" >
						<label style="width:120px">Unit Kerja Eselon I :</label>
						<?php //if ($this->session->userdata('unit_kerja_e1')=='-1'){
							$this->eselon1_model->getListEselon1($objectId);
						//} else { 
							//echo $this->eselon1_model->getNamaE1($this->session->userdata('unit_kerja_e1'));
							/* echo $this->session->userdata('unit_kerja_e1');
							$tmp ='tes';$this->session->userdata('unit_kerja_e1');
							echo '<input class="easyui-validatebox" type="text" id="kode_e1" name="kode_e1" size="10" required="true" value="tes">'; */
						 //} ?>
					</div>	
					<div class="fitem">
						<label style="width:120px">Sasaran :</label>
						<span id="divSasaranE1<?=$objectId?>">
						<?="";//chan $this->sasaran_eselon1_model->getListSasaranE1($objectId)?>
						</span>
					</div>
					<div class="fitem">
						<label style="width:120px">IKU :</label>
						<span id="divIkuE1<?=$objectId?>">
						<?="";//chan $this->sasaran_eselon1_model->getListSasaranE1($objectId)?>
						</span>
					</div>
					<br>
					<div class="fitem">
						<br>
						<table id="tbl<?=$objectId;?>" >
							<thead>
								<tr>									
									<th width="20px" bgcolor="#F4F4F4">No.</th>
									<th bgcolor="#F4F4F4">#</th>
									<th bgcolor="#F4F4F4" width="10%">Kode</th>
									<th width="80%" bgcolor="#F4F4F4">Kegiatan / Sub Kegiatan</th>
									<th bgcolor="#F4F4F4" align="right">Jumlah</th>
									
								</tr>
							</thead>
							<tbody id="tbodykegiatan<?=$objectId;?>">
								
							</tbody>
						</table>
						<br>
						
						<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveData<?=$objectId;?>()">Simpan</a> 
					</div>
				</form>
				</div>
					
			</div>	
		
