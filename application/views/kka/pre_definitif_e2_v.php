	<script  type="text/javascript" src="<?=base_url()?>public/js/autoNumeric.js"></script>
	
	<script  type="text/javascript" >
				
		$(function(){
     		$('.year').autoNumeric('init',{aSep: '', aDec: ',',vMin:'0',aPad:"false",vMax:"9999"});
		 	saveData<?=$objectId;?>=function(){
			
				$('#fm<?=$objectId;?>').form('submit',{
					url: base_url + 'kka/pre_definitif_e2/save',
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
							// reload and close tab
							$('#dg<?=$objectId;?>').datagrid('reload');
							$('#tt').tabs('close', 'Add Pra Monev Eselon II Pagu Definitif');
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
			function setListE2<?=$objectId?>(){
				var e1 = $("#kode_e1<?=$objectId;?>").val();
				$("#divEselon2<?=$objectId?>").load(
					base_url+"rujukan/eselon2/loadE2/"+e1+"/<?=$objectId;?>",
					//on complete
					function (){
						//setSasaranE2<?=$objectId?>($("#kode_e2<?=$objectId?>").val());
						$("#kode_e2<?=$objectId?>").change(function(){
							setSasaranE2<?=$objectId?>($(this).val(), $('#tahun<?=$objectId;?>').val());
							setKegiatanE2<?=$objectId;?>($(this).val(), $('#tahun<?=$objectId;?>').val()); 
						});	
						setSasaranE2<?=$objectId?>($("#kode_e2<?=$objectId?>").val(), $('#tahun<?=$objectId;?>').val());	
						setKegiatanE2<?=$objectId;?>($("#kode_e2<?=$objectId?>").val(), $('#tahun<?=$objectId;?>').val()); 
					}
				);
			 }
			 
			$("#tahun<?=$objectId;?>").change(function(){
			 	var e2 = $("#kode_e2<?=$objectId;?>").val();
				setSasaranE2<?=$objectId;?>(e2,$(this).val());
				 $("#kode_sasaran_e2<?=$objectId;?>").val("");
				setIkkE2<?=$objectId;?>(e2,$(this).val());
				setKegiatanE2<?=$objectId;?>(e2,$(this).val()); 
			});
			
			setKegiatanE2<?=$objectId?> = function(e2,tahun){
				<? if ($this->session->userdata('unit_kerja_e2')!='-1') {?>
				 e2 = '<?=$this->session->userdata('unit_kerja_e2');?>';
				<?}?>
				
				tahun =  $('#tahun<?=$objectId;?>').val();
				sasaran =  $("#kode_sasaran_e2<?=$objectId;?>").val();
				kodeikk =  $("#kode_ikk<?=$objectId;?>").val();
				
				if (sasaran=="") sasaran = "-1";
				if (kodeikk==null) kodeikk="-1";
				$("#tbodykegiatan<?=$objectId;?>").load(
					base_url+"kka/pre_definitif_e2/getKegiatan_e2/"+e2+"/"+tahun+"/"+sasaran+"/"+kodeikk,
					function(){
						$('.money').autoNumeric('init',{aSep: '.', aDec: ',',vMin:'0',aPad:"false",vMax:"999999999999999"});

					}
				);
			}
			
			
			setSasaranE2<?=$objectId;?> = function(e2, tahun){
				<? if ($this->session->userdata('unit_kerja_e2')!='-1') {?>
				 e2 = '<?=$this->session->userdata('unit_kerja_e2');?>';
				<?}?>
			
				tahun =  $('#tahun<?=$objectId;?>').val();
				$("#divSasaranE2<?=$objectId?>").load(
					base_url+"kka/pre_definitif_e2/getListSasaranE2/"+"<?=$objectId;?>"+"/"+e2+"/"+tahun,
					function(){
						$('textarea').autosize();  
						if($("#drop<?=$objectId;?>").is(":visible")){
							$("#drop<?=$objectId;?>").slideUp("slow");
						}
						
						$("#txtkode_sasaran_e2<?=$objectId;?>").click(function(){
							$("#drop<?=$objectId;?>").slideDown("slow");
						});
						
						$("#drop<?=$objectId;?> li").click(function(e){
							var chose = $(this).text();
							//alert(chose);
							$("#txtkode_sasaran_e2<?=$objectId;?>").text(chose);
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
			
			setIkkE2<?=$objectId;?> = function(e2, tahun){
				<? if ($this->session->userdata('unit_kerja_e2')!='-1') {?>
				 e2 = '<?=$this->session->userdata('unit_kerja_e2');?>';
				<?}?>
				
				tahun =  $('#tahun<?=$objectId;?>').val();
				sasaran =  $("#kode_sasaran_e2<?=$objectId;?>").val();
				if (sasaran=="") sasaran = "-1";
				$("#divIkk<?=$objectId?>").load(
					base_url+"kka/pre_definitif_e2/getListIkuE2/"+"<?=$objectId;?>"+"/"+e2+"/"+tahun+"/"+sasaran,
					function(){
						$('textarea').autosize();  
						if($("#dropIku<?=$objectId;?>").is(":visible")){
							$("#dropIku<?=$objectId;?>").slideUp("slow");
						}
						
						$("#txtkode_ikk<?=$objectId;?>").click(function(){
							$("#dropIku<?=$objectId;?>").slideDown("slow");
						});
						
						$("#dropIku<?=$objectId;?> li").click(function(e){
							var chose = $(this).text();
							//alert(chose);
							$("#txtkode_ikk<?=$objectId;?>").text(chose);
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
			
			calculateKegiatan<?=$objectId?>=function(idxKegiatan,max_sub_idx){
				$('.money').autoNumeric('init',{aSep: '.', aDec: ',',vMin:'0',aPad:"false",vMax:"999999999999999"});
				//alert($("#"+kegiatanJumlahId).val());
				//alert($("#jumlah_"+idx).val());
				var jumlahSubkegiatan=0, jumlahKegiatan = 0, idkegiatan;
				
				//jumlahKegiatan = parseFloat($("#jumlah_"+idxKegiatan).autoNumeric('get'));
				//if (!jumlahKegiatan) jumlahKegiatan = parseFloat(0);
				for (idx=(idxKegiatan+1);idx<max_sub_idx;idx++){
					jumlahSubkegiatan = parseFloat($("#jumlah_"+idx).autoNumeric('get'));
					if (!jumlahSubkegiatan) jumlahSubkegiatan = parseFloat(0);
					jumlahKegiatan = jumlahKegiatan + jumlahSubkegiatan;
				}
		        $("#jumlah_"+idxKegiatan).autoNumeric('set',(jumlahKegiatan));	
			}
			
			
			
			$("#kode_e2<?=$objectId?>").change(function(){
				setSasaranE2<?=$objectId;?>($(this).val(), $('#tahun<?=$objectId;?>').val());
			});
			
				
			  //inisialisasi
			 setListE2<?=$objectId?>();
			 
			//--------------------
		});

	</script>
	
	
	<!-- Dari Stef -->
	<script type="text/javascript">
		
		//chan-----------
		function setSasaran<?=$objectId;?>(valu){
			
			if(valu != null){
				document.getElementById('kode_sasaran_e2<?=$objectId;?>').value = valu;
			}
			var e2 = $("#kode_e2<?=$objectId;?>").val();
			var tahun = $("#tahun<?=$objectId;?>").val();
			setIkkE2<?=$objectId;?> (e2,tahun);	
			setKegiatanE2<?=$objectId;?>(e2,tahun); 
			// set IKU E1 berdasarkan unit kerja eselon 1
			/* var kode_e1 = $('#kode_e1<?=$objectId;?>').val();
			var tahun = $('#tahun<?=$objectId;?>').val();
			
			if(tahun.length < 4){
				$("#tbodykegiatan<?=$objectId;?>").html('<tr><td colspan="5">Isi Tahun dengan benar</td></tr>');
			}else{
			//	setSasaranE2<?=$objectId;?>(kode_e1, tahun);
				$("#tbodykegiatan<?=$objectId;?>").load(
					base_url+"kka/pre_definitif_e2/getIKU_e1/"+kode_e1+"/"+tahun
				);
			} */
			
		}
		//chan-----------
		function setIkk<?=$objectId;?>(valu){
			
			if(valu != null){
				document.getElementById('kode_ikk<?=$objectId;?>').value = valu;
			}	
			var e2 = $("#kode_e2<?=$objectId;?>").val();
			var tahun = $("#tahun<?=$objectId;?>").val();
			setKegiatanE2<?=$objectId;?>(e2,tahun); 		
			
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
								
				<div region="center" border="true" title="Tambah Data Pra Definitif Eselon II">
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
						<label style="width:120px">Unit Kerja Eselon II :</label>
						<span id="divEselon2<?=$objectId?>">
						<?
						/* CHAN 
						if ($this->session->userdata('unit_kerja_e2')=='-1'){
							$this->eselon2_model->getListEselon2($objectId);
						} else { 
							echo $this->eselon2_model->getNamaE2($this->session->userdata('unit_kerja_e2'));
						 } */?>
						 </span>
					</div>
					<div class="fitem">
						<label style="width:120px">Sasaran :</label>
						<span id="divSasaranE2<?=$objectId?>">
						<?="";//chan $this->sasaran_eselon1_model->getListSasaranE1($objectId)?>
						</span>
					</div>
					<div class="fitem">
						<label style="width:120px">IKK :</label>
						<span id="divIkk<?=$objectId?>">
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
						<!--<a href="#" class="easyui-linkbutton" iconCls="icon-add" onclick="addRow<?=$objectId;?>('tbl<?=$objectId;?>')">Tambah IKU</a>
						<a href="#" class="easyui-linkbutton" iconCls="icon-remove" onclick="deleteRow<?=$objectId;?>('tbl<?=$objectId;?>')">Hapus IKU</a> -->
						<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveData<?=$objectId;?>()">Simpan</a> 
					</div>
				</form>
				</div>
					
			</div>	
		
