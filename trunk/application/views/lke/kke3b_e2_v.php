	<script  type="text/javascript" >
		$(function(){
			var url;
			
			clearFilter<?=$objectId;?> = function (){
				//ambil nilai-nilai filter
				$("#filter_tahun<?=$objectId;?>").val(''); 			
				$("#filter_e2<?=$objectId;?>").val('');			
				$("#filter_sasaran<?=$objectId;?>").val('');			
				$("#filter_iku<?=$objectId;?>").val('');			
				//$('#dg<?=$objectId;?>').datagrid({url:"<?=base_url()?>lke/kke3b_e2/grid/"+filtahun+"/"+filnama+"/"+filalamat});
					//$('#dg<?=$objectId;?>').datagrid({url:"<?=base_url()?>lke/kke3b_e2/grid/"+filtahun+"/"+filnama+"/"+filalamat});
			}
			
				//tipe 1=grid, 2=pdf, 3=excel
			getUrl<?=$objectId;?> = function (tipe){
				//jika tipe pdf&excel kirim jg paging datanya agar sesuai dengan grid				
				var paging="";
				if ((tipe==2)||(tipe==3)){
					var page =  $('#dg<?=$objectId;?>').datagrid('options').pageNumber;
					var rows = $('#dg<?=$objectId;?>').datagrid('options').pageSize;
				//	alert(page);
					if (rows==null) rows = "-1";
					if (page==null) page = "-1";
					paging = "/"+page+"/"+rows;						
				}
			
					//ambil nilai-nilai filter
				//alert($("#filter_tahun<?=$objectId;?>").val());
				var filtahun = $("#filter_tahun<?=$objectId;?>").val();
				<? if ($this->session->userdata('unit_kerja_e2')==-1){?>
					var file2 = $("#filter_e2<?=$objectId;?>").val();
				<?} else {?>
					var file2 = "<?=$this->session->userdata('unit_kerja_e2');?>";
				<?}?>
				
				 if(filtahun==null) filtahun ="-1";
				 if((file2==null)||(file2.length==0)) file2 ="-1";
				var filsasaran = "-1";
				var filiku = "-1";
				
				if (tipe==1){
					return "<?=base_url()?>lke/kke3b_e2/grid/"+filtahun+"/"+file2;
				}
				else if (tipe==2){
					return "<?=base_url()?>lke/kke3b_e2/pdf/"+filtahun+"/"+file2+"/"+filsasaran+"/"+filiku+paging;
				}else if (tipe==3){
					return "<?=base_url()?>lke/kke3b_e2/excel/"+filtahun+"/"+file2+"/"+filsasaran+"/"+filiku+paging;
				}
				
			}
			
			
			var url;
			newData<?=$objectId;?> = function (){  
				/* var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
				if (row){
					if (row.has_child) {
						alert("Pilih data subkomponen terlebih dahulu");
						return false;
					} */
					
					var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
					if (row){
						$('#dlg<?=$objectId;?>').dialog('open').dialog('setTitle','Add KKE3B IK');  
						$('#fm<?=$objectId;?>').form('clear');  						
						//initCombo<?=$objectId?>();
						url = base_url+'lke/kke3b_e2/save';  
						$("#kke3b_e2_id<?=$objectId?>").val(row.kke3b_e2_id);
						$("#tahun<?=$objectId?>").val(row.tahun);						
						$("#spanTahun<?=$objectId?>").text(row.tahun);
						$("#kode_e2<?=$objectId?>").val(row.kode_e2);
						$("#spanE2<?=$objectId?>").text(row.nama_e2);
						$("#kode_sasaran_e2<?=$objectId?>").val(row.kode_sasaran_e2);
						$("#spanSasaran<?=$objectId?>").text(row.sasaran_strategis);
						$("#kode_ikk<?=$objectId?>").val(row.kode_ikk);
						$("#spanIku<?=$objectId?>").text(row.indikator_kinerja);
						
						<? $i=0;
						foreach($listIndex_renstra_a->result() as $r){?>
							$('input:radio[name=renstra_a]:nth(<?=$i?>)').prop('checked',(row.renstra_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_rkt_a->result() as $r){?>
							$('input:radio[name=rkt_a]:nth(<?=$i?>)').prop('checked',(row.rkt_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_pk_a->result() as $r){?>
							$('input:radio[name=pk_a]:nth(<?=$i?>)').prop('checked',(row.pk_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_iku_measurable_a->result() as $r){?>
							$('input:radio[name=iku_measurable_a]:nth(<?=$i?>)').prop('checked',(row.iku_measurable_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_iku_hasil_a->result() as $r){?>
							$('input:radio[name=iku_hasil_a]:nth(<?=$i?>)').prop('checked',(row.iku_hasil_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_iku_relevan_a->result() as $r){?>
							$('input:radio[name=iku_relevan_a]:nth(<?=$i?>)').prop('checked',(row.iku_relevan_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_iku_diukur_a->result() as $r){?>
							$('input:radio[name=iku_diukur_a]:nth(<?=$i?>)').prop('checked',(row.iku_diukur_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_kriteria_measurable_a->result() as $r){?>
							$('input:radio[name=kriteria_measurable_a]:nth(<?=$i?>)').prop('checked',(row.kriteria_measurable_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_kriteria_hasil_a->result() as $r){?>
							$('input:radio[name=kriteria_hasil_a]:nth(<?=$i?>)').prop('checked',(row.kriteria_hasil_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_kriteria_relevan_a->result() as $r){?>
							$('input:radio[name=kriteria_relevan_a]:nth(<?=$i?>)').prop('checked',(row.kriteria_relevan_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_kriteria_diukur_a->result() as $r){?>
							$('input:radio[name=kriteria_diukur_a]:nth(<?=$i?>)').prop('checked',(row.kriteria_diukur_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_pengukuran_a->result() as $r){?>
							$('input:radio[name=pengukuran_a]:nth(<?=$i?>)').prop('checked',(row.pengukuran_a=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						
						
						<? $i=0;
						foreach($listIndex_renstra_b->result() as $r){?>
							$('input:radio[name=renstra_b]:nth(<?=$i?>)').prop('checked',(row.renstra_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_rkt_b->result() as $r){?>
							$('input:radio[name=rkt_b]:nth(<?=$i?>)').prop('checked',(row.rkt_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_pk_b->result() as $r){?>
							$('input:radio[name=pk_b]:nth(<?=$i?>)').prop('checked',(row.pk_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_iku_measurable_b->result() as $r){?>
							$('input:radio[name=iku_measurable_b]:nth(<?=$i?>)').prop('checked',(row.iku_measurable_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_iku_hasil_b->result() as $r){?>
							$('input:radio[name=iku_hasil_b]:nth(<?=$i?>)').prop('checked',(row.iku_hasil_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_iku_relevan_b->result() as $r){?>
							$('input:radio[name=iku_relevan_b]:nth(<?=$i?>)').prop('checked',(row.iku_relevan_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_iku_diukur_b->result() as $r){?>
							$('input:radio[name=iku_diukur_b]:nth(<?=$i?>)').prop('checked',(row.iku_diukur_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_kriteria_measurable_b->result() as $r){?>
							$('input:radio[name=kriteria_measurable_b]:nth(<?=$i?>)').prop('checked',(row.kriteria_measurable_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_kriteria_hasil_b->result() as $r){?>
							$('input:radio[name=kriteria_hasil_b]:nth(<?=$i?>)').prop('checked',(row.kriteria_hasil_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_kriteria_relevan_b->result() as $r){?>
							$('input:radio[name=kriteria_relevan_b]:nth(<?=$i?>)').prop('checked',(row.kriteria_relevan_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_kriteria_diukur_b->result() as $r){?>
							$('input:radio[name=kriteria_diukur_b]:nth(<?=$i?>)').prop('checked',(row.kriteria_diukur_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						<? $i=0;
						foreach($listIndex_pengukuran_b->result() as $r){?>
							$('input:radio[name=pengukuran_b]:nth(<?=$i?>)').prop('checked',(row.pengukuran_b=='<?=$r->index_mutu?>'));
						<? $i++;
						}?>
						
						/* $('input:radio[name=renstra_a]:nth(0)').prop('checked',(row.renstra_a=='T'));
						$('input:radio[name=renstra_a]:nth(1)').prop('checked',(row.renstra_a=='Y'));					
						$('input:radio[name=rkt_a]:nth(0)').prop('checked',(row.rkt_a=='T'));
						$('input:radio[name=rkt_a]:nth(1)').prop('checked',(row.rkt_a=='Y'));						
						$('input:radio[name=pk_a]:nth(0)').prop('checked',(row.pk_a=='T'));
						$('input:radio[name=pk_a]:nth(1)').prop('checked',(row.pk_a=='Y'));						
						$('input:radio[name=iku_measurable_a]:nth(0)').prop('checked',(row.iku_measurable_a=='T'));
						$('input:radio[name=iku_measurable_a]:nth(1)').prop('checked',(row.iku_measurable_a=='Y'));					
						$('input:radio[name=iku_hasil_a]:nth(0)').prop('checked',(row.iku_hasil_a=='T'));
						$('input:radio[name=iku_hasil_a]:nth(1)').prop('checked',(row.iku_hasil_a=='Y'));
						$('input:radio[name=iku_relevan_a]:nth(0)').prop('checked',(row.iku_relevan_a=='T'));
						$('input:radio[name=iku_relevan_a]:nth(1)').prop('checked',(row.iku_relevan_a=='Y'));					
						$('input:radio[name=iku_diukur_a]:nth(0)').prop('checked',(row.iku_diukur_a=='T'));
						$('input:radio[name=iku_diukur_a]:nth(1)').prop('checked',(row.iku_diukur_a=='Y'));						
						$('input:radio[name=kriteria_measurable_a]:nth(0)').prop('checked',(row.kriteria_measurable_a=='T'));
						$('input:radio[name=kriteria_measurable_a]:nth(1)').prop('checked',(row.kriteria_measurable_a=='Y'));
						$('input:radio[name=kriteria_hasil_a]:nth(0)').prop('checked',(row.kriteria_hasil_a=='T'));
						$('input:radio[name=kriteria_hasil_a]:nth(1)').prop('checked',(row.kriteria_hasil_a=='Y'));
						$('input:radio[name=kriteria_relevan_a]:nth(0)').prop('checked',(row.kriteria_relevan_a=='T'));
						$('input:radio[name=kriteria_relevan_a]:nth(1)').prop('checked',(row.kriteria_relevan_a=='Y'));	
						$('input:radio[name=kriteria_diukur_a]:nth(0)').prop('checked',(row.kriteria_diukur_a=='T'));
						$('input:radio[name=kriteria_diukur_a]:nth(1)').prop('checked',(row.kriteria_diukur_a=='Y'));
						$('input:radio[name=pengukuran_a]:nth(0)').prop('checked',(row.pengukuran_a=='T'));
						$('input:radio[name=pengukuran_a]:nth(1)').prop('checked',(row.pengukuran_a=='Y'));
						
						$('input:radio[name=renstra_b]:nth(0)').prop('checked',(row.renstra_b=='T'));
						$('input:radio[name=renstra_b]:nth(1)').prop('checked',(row.renstra_b=='Y'));					
						$('input:radio[name=rkt_b]:nth(0)').prop('checked',(row.rkt_b=='T'));
						$('input:radio[name=rkt_b]:nth(1)').prop('checked',(row.rkt_b=='Y'));						
						$('input:radio[name=pk_b]:nth(0)').prop('checked',(row.pk_b=='T'));
						$('input:radio[name=pk_b]:nth(1)').prop('checked',(row.pk_b=='Y'));						
						$('input:radio[name=iku_measurable_b]:nth(0)').prop('checked',(row.iku_measurable_b=='T'));
						$('input:radio[name=iku_measurable_b]:nth(1)').prop('checked',(row.iku_measurable_b=='Y'));					
						$('input:radio[name=iku_hasil_b]:nth(0)').prop('checked',(row.iku_hasil_b=='T'));
						$('input:radio[name=iku_hasil_b]:nth(1)').prop('checked',(row.iku_hasil_b=='Y'));
						$('input:radio[name=iku_relevan_b]:nth(0)').prop('checked',(row.iku_relevan_b=='T'));
						$('input:radio[name=iku_relevan_b]:nth(1)').prop('checked',(row.iku_relevan_b=='Y'));					
						$('input:radio[name=iku_diukur_b]:nth(0)').prop('checked',(row.iku_diukur_b=='T'));
						$('input:radio[name=iku_diukur_b]:nth(1)').prop('checked',(row.iku_diukur_b=='Y'));						
						$('input:radio[name=kriteria_measurable_b]:nth(0)').prop('checked',(row.kriteria_measurable_b=='T'));
						$('input:radio[name=kriteria_measurable_b]:nth(1)').prop('checked',(row.kriteria_measurable_b=='Y'));
						$('input:radio[name=kriteria_hasil_b]:nth(0)').prop('checked',(row.kriteria_hasil_b=='T'));
						$('input:radio[name=kriteria_hasil_b]:nth(1)').prop('checked',(row.kriteria_hasil_b=='Y'));
						$('input:radio[name=kriteria_relevan_b]:nth(0)').prop('checked',(row.kriteria_relevan_b=='T'));
						$('input:radio[name=kriteria_relevan_b]:nth(1)').prop('checked',(row.kriteria_relevan_b=='Y'));	
						$('input:radio[name=kriteria_diukur_b]:nth(0)').prop('checked',(row.kriteria_diukur_b=='T'));
						$('input:radio[name=kriteria_diukur_b]:nth(1)').prop('checked',(row.kriteria_diukur_b=='Y'));
						$('input:radio[name=pengukuran_b]:nth(0)').prop('checked',(row.pengukuran_b=='T'));
						$('input:radio[name=pengukuran_b]:nth(1)').prop('checked',(row.pengukuran_b=='Y')); */
					
					}
						
					else {
						alert('Data IKU belum dipilih!');
					}
				/* }	
				else {
					alert("Pilih data subkomponen terlebih dahulu");
				} */
				//addTab("Add PK Kementerian", "lke/kke3b_e2/add");
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
								title: 'Sucsees',
								msg: result.msg
							}); */
							$('#dlg<?=$objectId;?>').dialog('close');		// close the dialog
							$('#dg<?=$objectId;?>').datagrid('reload');	// reload the user data
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
			
			searchData<?=$objectId;?> = function (){
				$('#dg<?=$objectId;?>').datagrid({
					url:getUrl<?=$objectId;?>(1),
					pageNumber : 1,
					onLoadSuccess:function(data){
						//var  rows = $('#dg<?=$objectId;?>').datagrid('getRows');
					//	alert(rows.length);
						$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						prepareMerge<?=$objectId;?>(data);
					},					
					queryParams:{lastNo:'0'}
				}); 
			}
			//end searhData 
			
			printData<?=$objectId;?>=function(){			
				//$.jqURL.loc(getUrl<?=$objectId;?>(2),{w:800,h:600,wintype:"_blank"});
				//window.open(getUrl<?=$objectId;?>(2));;
				alert("Fasilitas Pdf belum tersedia");
			}
			toExcel<?=$objectId;?>=function(){
				alert("Fasilitas Excel belum tersedia");
				//window.open(getUrl<?=$objectId;?>(3));;
			}
			
			prepareMerge<?=$objectId;?> = function(data){
				var  rows = data.rows;//$('#dg<?=$objectId;?>').datagrid('getRows');
				var merges = new Array();
				var sasaran = "";
				var idx=0;
				var rowSpan = 0;
				//alert(rows.length);
				for (var i=0;i<rows.length;i++){
					
					if (sasaran!=rows[i].sasaran_strategis){
						sasaran =rows[i].sasaran_strategis;
					//	alert(sasaran);
						if (i>0){
					//	alert("kadieu og gening");
							merges[idx] = new Array();
							merges[idx][0] =i-rowSpan-1;//index
							merges[idx][1] =rowSpan+1;//rowspan
							idx++;
							rowSpan =0;
						}
						else {
							//rowSpan++;
						}
						//alert(sasaran);
					}
					else{
						if (i==rows.length-1){
							//alert("kadieu tes");
							merges[idx] = new Array();
							merges[idx][0] =i-rowSpan-1;//index
							merges[idx][1] =rowSpan+2;//rowspan
							idx++;
							rowSpan =0;
						}	  
						rowSpan++;
					}
					/*  if (i==rows.length-1){
						//alert("kadieu tes");
						merges[idx] = new Array();
						merges[idx][0] =idx;//index
						merges[idx][1] =rowSpan;//rowspan
						idx++;
						rowSpan =0;
					}	  */
					
				}
				
				
				
				//alert(merges.length);
				for(var i=0; i<merges.length; i++){
				//alert(merges[i][1]);
						$('#dg<?=$objectId;?>').datagrid('mergeCells',{
							index:merges[i][0],
							field:'sasaran_strategis',
							rowspan:merges[i][1]
						});
						 $('#dg<?=$objectId;?>').datagrid('mergeCells',{
							index:merges[i][0],
							field:'no',
							rowspan:merges[i][1]
						}); 
				}
				
				
			}
			
			formatPrice=function (val,row){
				return val;//($.fn.autoNumeric.Format("txtAmount"+idx,total,{aSep:".",aDec:",",mDec:2}));
				/* if (val < 20){
					return '<span style="color:red;">('+val+')</span>';
				} else {
					return val;
				} */
			}

			
			setTimeout(function(){
				/* $('#dg<?=$objectId;?>').datagrid({
				url:"<?=base_url()?>lke/kke3b_e2/grid",
				queryParams:{lastNo:'0'},		
					onLoadSuccess:function(data){
						$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						prepareMerge<?=$objectId;?>(data);
					}}); */
					searchData<?=$objectId?>();
			},50);
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
	</style>
	<div id="tb<?=$objectId;?>" style="height:auto">
	  <table border="0" cellpadding="1" cellspacing="1" width="100%">
	  <tr>
		<td>
		  <div class="fsearch" >
			
			<table border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td>Tahun :</td>
				<td>
				<?=$this->ikk_model->getListTahun($objectId,"filter_tahun","false",false);?>
				</td>
			</tr>
			<tr>
					<td>Unit Kerja Eselon I :</td>
					<td>
					<?=$this->eselon1_model->getListFilterEselon1($objectId,$this->session->userdata('unit_kerja_e1'))?>
					</td>
				</tr>
				<tr>
					<td>Unit Kerja Eselon II :</td>
					<td><span class="fitem" id="divUnitKerja<?=$objectId;?>">
					<?=$this->eselon2_model->getListFilterEselon2($objectId,$this->session->userdata('unit_kerja_e1'),$this->session->userdata('unit_kerja_e2'),false)?>
					</span>
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
	  <? if($this->sys_menu_model->cekAkses('ADD;',321,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="newData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-ok" plain="true">Set Kinerja</a>  
		<?}?>
	
		
			<? if($this->sys_menu_model->cekAkses('PRINT;',253,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a 	href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
			<?}?>
			<? if($this->sys_menu_model->cekAkses('EXCEL;',253,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
			<?}?>
	  </div>
	</div>
	
	<table id="dg<?=$objectId;?>"  style="height:auto;width:auto" title="Laporan KKE3A IK Eselon II" toolbar="#tb<?=$objectId;?>" fitColumns="false" singleSelect="true" rownumbers="false" pagination="true"  nowrap="false" showFooter="true">
	  <thead>
	  <tr>
		
		<th field="no" rowspan="5" sortable="false" width="25px">No.</th>
		<th field="tahun" rowspan="5" sortable="false" hidden="true" width="25px">tahun</th>
		<th field="kode_e2" rowspan="5" sortable="false" hidden="true" >kode_e2</th>
		<th field="nama_e2" rowspan="5" sortable="false" hidden="true" >nama_e2</th>
		<th field="sasaran_strategis"  rowspan="5"  sortable="false" width="250px">Sasaran Strategis</th>
		<th  sortable="false" colspan="2" rowspan="4" width="250px">Indikator Kinerja Utama</th>
		
		<th colspan="48" sortable="false" align="center" >Indikator Kinerja Terukur Dalam Dokumen Perencanaan</th>
		<th colspan="16" sortable="false" align="center" >Kriteria</th>
		<th colspan="4" sortable="false" align="center" >Pengukuran</th>
		
	  </tr>
	  <tr>				
		<th sortable="false" rowspan="2" colspan="4">RENSTRA IP</th>
		<th sortable="false" rowspan="2" colspan="4">RKT IP</th>
		<th sortable="false" rowspan="2" colspan="4">PK IP</th>
		<th sortable="false" colspan="16">IKU</th>	
		<th sortable="false" rowspan="2" colspan="4">Measurable</th>		
		<th sortable="false" rowspan="2" colspan="4">Orientasi Hasil</th>		
		<th sortable="false" rowspan="2" colspan="4">Relevan</th>		
		<th sortable="false" rowspan="2" colspan="4">Diukur</th>	
		<th sortable="false" rowspan="2" colspan="4">IP</th>	
	  </tr>
	  <tr>						
		<th sortable="false" colspan="4">Measurable</th>		
		<th sortable="false" colspan="4">Orientasi Hasil</th>		
		<th sortable="false" colspan="4">Relevan</th>		
		<th sortable="false" colspan="4">Diukur</th>		
	  </tr>
	  <tr>				
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja A</th>
		<th sortable="false"  halign="center" align="center" colspan="2" width="110px">Unit Kerja B</th>
		
	  </tr>
	  <tr>		
		<th field="no_indikator" align="center" halign="center" sortable="false" width="30px" >No.</th>
		<th field="indikator_kinerja" align="left" halign="center" sortable="false" width="220px" >Deskripsi</th>
		<th field="renstra_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="renstra_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="renstra_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="renstra_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="rkt_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="rkt_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="rkt_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="rkt_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="pk_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="pk_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="pk_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="pk_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="iku_measurable_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="iku_measurable_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="iku_measurable_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="iku_measurable_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="iku_hasil_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="iku_hasil_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="iku_hasil_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="iku_hasil_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="iku_relevan_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="iku_relevan_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="iku_relevan_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="iku_relevan_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="iku_diukur_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="iku_diukur_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="iku_diukur_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="iku_diukur_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="kriteria_measurable_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="kriteria_measurable_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="kriteria_measurable_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="kriteria_measurable_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="kriteria_hasil_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="kriteria_hasil_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="kriteria_hasil_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="kriteria_hasil_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="kriteria_relevan_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="kriteria_relevan_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="kriteria_relevan_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="kriteria_relevan_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="kriteria_diukur_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="kriteria_diukur_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="kriteria_diukur_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="kriteria_diukur_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="pengukuran_a" align="center" halign="center" sortable="false" >Index</th>
		<th field="pengukuran_a_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		<th field="pengukuran_b" align="center" halign="center" sortable="false" >Index</th>
		<th field="pengukuran_b_nilai" align="center" halign="center" sortable="false" >Nilai</th>
		
		
	  </tr>
	 
	  </thead>  
	</table>
	
	<!-- Area untuk Form Add/Edit >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
	
	<div id="dlg<?=$objectId;?>" class="easyui-dialog" style="width:720px;height:400px;padding:10px 20px" closed="true"  buttons="#dlg-buttons">
		<!----------------Edit title-->
		
		<form id="fm<?=$objectId;?>" method="post" >			
			
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Tahun :</label>
				<span id="spanTahun<?=$objectId?>"></span>
				<input type="hidden" id="tahun<?=$objectId?>" name="tahun">
				<input type="hidden" id="kke3b_e2_id<?=$objectId?>" name="kke3b_e2_id"/>				
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Unit Kerja Eselon II :</label>
				<span id="spanE2<?=$objectId?>"></span>
				<input type="hidden" id="kode_e2<?=$objectId?>" name="kode_e2">
				
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">Sasaran Eselon I :</label>					
					<span id="spanSasaran<?=$objectId?>"></span>
					<input type="hidden" id="kode_sasaran_e2<?=$objectId?>" name="kode_sasaran_e2">
			</div>
			<div class="fitem">
				<label style="width:130px;vertical-align:top">IKU Eselon I :</label>
				<?//=$this->iku_kl_model->getListIKU_KL($objectId,"",false)?>
				<input type="hidden" id="kode_ikk<?=$objectId?>" name="kode_ikk">
				<span id="spanIku<?=$objectId?>">
				</span>
			</div>
			<div class="fitem">
				
				<hr>
			</div>
			<div class="fitem">
				<table border="0">
					<tr style="font-weight:bold">
						<td colspan="2">Unit Kerja A</td>
						<td width="40px" rowspan="12">&nbsp;</td>
						<td colspan="2">Unit Kerja B</td>
					</tr>
					<tr>
						<td><label style="width:130px;vertical-align:top">Renstra :</label></td>
						<td><?=$renstra_a_radio?></td>
						<td><label style="width:130px;vertical-align:top">Renstra :</label></td>
						<td><?=$renstra_b_radio?></td>
					</tr>	
					<tr>
						<td><label style="width:130px;vertical-align:top">RKT :</label></td>
						<td><?=$rkt_a_radio?></td>
						<td><label style="width:130px;vertical-align:top">RKT :</label></td>
						<td><?=$rkt_b_radio?></td>
					</tr>
					<tr>
						<td><label style="width:130px;vertical-align:top">PK :</label></td>
						<td><?=$pk_a_radio?></td>
						<td><label style="width:130px;vertical-align:top">PK :</label></td>
						<td><?=$pk_b_radio?></td>
					</tr>
					<tr>
						<td><label style="width:130px;vertical-align:top">IKU Measurable :</label></td>
						<td><?=$iku_measurable_a_radio?></td>
						<td><label style="width:130px;vertical-align:top">IKU Measurable :</label></td>
						<td><?=$iku_measurable_b_radio?></td>
					</tr>
					<tr>
						<td><label style="width:130px;vertical-align:top">IKU Orientasi Hasil :</label></td>
						<td><?=$iku_hasil_a_radio?></td>
						<td><label style="width:130px;vertical-align:top">IKU Orientasi Hasil :</label></td>
						<td><?=$iku_hasil_b_radio?></td>
					</tr>
					<tr>
						<td><label style="width:130px;vertical-align:top">IKU Relevan :</label></td>
						<td><?=$iku_relevan_a_radio?></td>
						<td><label style="width:130px;vertical-align:top">IKU Relevan :</label></td>
						<td><?=$iku_relevan_b_radio?></td>
					</tr>
					<tr>
						<td><label style="width:130px;vertical-align:top">IKU Diukur :</label></td>
						<td><?=$iku_diukur_a_radio?></td>
						<td><label style="width:130px;vertical-align:top">IKU Diukur :</label></td>
						<td><?=$iku_diukur_b_radio?></td>
					</tr>
					<tr>
						<td><label style="width:130px;vertical-align:top">Kriteria Measurable :</label></td>
						<td><?=$kriteria_measurable_a_radio?></td>
						<td><label style="width:130px;vertical-align:top">Kriteria Measurable :</label></td>
						<td><?=$kriteria_measurable_b_radio?></td>
						
					</tr>
					<tr>
						<td><label style="width:130px;vertical-align:top">Kriteria Orientasi Hasil :</label></td>
						<td><?=$kriteria_hasil_a_radio?></td>
						<td><label style="width:130px;vertical-align:top">Kriteria Orientasi Hasil :</label></td>
						<td><?=$kriteria_hasil_b_radio?></td>
					</tr>
					<tr>
						<td><label style="width:130px;vertical-align:top">Kriteria Relevan :</label></td>
						<td><?=$kriteria_relevan_a_radio?></td>
						<td><label style="width:130px;vertical-align:top">Kriteria Relevan :</label></td>
						<td><?=$kriteria_relevan_b_radio?></td>
					</tr>
					<tr>
						<td><label style="width:130px;vertical-align:top">Kriteria Diukur :</label></td>
						<td><?=$kriteria_diukur_a_radio?></td>
						<td><label style="width:130px;vertical-align:top">Kriteria Diukur :</label></td>
						<td><?=$kriteria_diukur_b_radio?></td>
					</tr>
				</table>
			</div>	
		</form>
		<div id="dlg-buttons">
			<!----------------Edit title-->
			<a href="#" id="saveBtn<?=$objectId;?>" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveData<?=$objectId;?>()">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg<?=$objectId;?>').dialog('close')">Cancel</a>
		</div>
	</div>
