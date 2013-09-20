	<script  type="text/javascript" >
		$(function(){
			var url;
						
			clearFilter<?=$objectId;?> = function (){
				//ambil nilai-nilai filter
				$("#filter_tahun<?=$objectId;?>").val('');							
				$("#filter_sasaran<?=$objectId;?>").val('');			
				$("#filter_iku<?=$objectId;?>").val('');			
			}

			searchData<?=$objectId;?> = function (){
				$('#dg<?=$objectId;?>').datagrid({
					url:getUrl<?=$objectId;?>(1),
					queryParams:{lastNo:'0'},	
					pageNumber : 1,
					onLoadSuccess:function(data){	
						$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						prepareMerge<?=$objectId;?>(data);
					}});
			}
			//end searchData 
		
			printData<?=$objectId;?>=function(){			
				//$.jqURL.loc(getUrl<?=$objectId;?>(2),{w:800,h:600,wintype:"_blank"});
				window.open(getUrl<?=$objectId;?>(2));;
				//alert("Fasilitas Pdf belum tersedia");
			}

			toExcel<?=$objectId;?>=function(){
				//alert("Fasilitas Excel belum tersedia");
				window.open(getUrl<?=$objectId;?>(3));;
			}			

			//tipe 1=grid, 2=pdf, 3=excel
			getUrl<?=$objectId;?> = function (tipe){
				//jika tipe pdf&excel kirim jg paging datanya agar sesuai dengan grid				
				var paging="";
				if ((tipe==2)||(tipe==3)){
					var page =  $('#dg<?=$objectId;?>').datagrid('options').pageNumber;
					var rows = $('#dg<?=$objectId;?>').datagrid('options').pageSize;
					if (rows==null) rows = "-1";
					if (page==null) page = "-1";
					paging = "/"+page+"/"+rows;						
				}
			
				//ambil nilai-nilai filter
				var filtahun = $("#filter_tahun<?=$objectId;?>").val();
				var filsasaran = $("#kode_sasaran_kl<?=$objectId;?>").val();
				var filiku = $("#filter_iku<?=$objectId;?>").val();
				//encode parameter
				
				if (filtahun==null) filtahun ="-1";
				if (filsasaran==null) filsasaran = "-1";
				if (filiku==null) filiku = "-1";
				
				if (tipe==1){
					return"<?=base_url()?>penetapan/rpt_penetapankl/grid/"+filtahun+"/"+filsasaran;
				}
				else if (tipe==2){
					return "<?=base_url()?>penetapan/rpt_penetapankl/pdf/"+filtahun+"/"+filsasaran+"/"+filiku+paging;
				}else if (tipe==3){
					return "<?=base_url()?>penetapan/rpt_penetapankl/excel/"+filtahun+"/"+filsasaran+"/"+filiku+paging;
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
				
				$('#dg<?=$objectId;?>').datagrid('mergeCells',{
						index:0,
						field:'program',
						rowspan:rows.length
				});
				
				/* $('#dg<?=$objectId;?>').datagrid('mergeCells',{
					index:1,
					field:'sasaran_strategis',
					rowspan:2
				}); */
			}
			
			setTimeout(function(){
				/* $('#dg<?=$objectId;?>').datagrid({
					url:"<?=base_url()?>penetapan/rpt_penetapankl/grid",
					queryParams:{lastNo:'0'},	
					onLoadSuccess:function(data){
						$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						prepareMerge<?=$objectId;?>(data);
					}
				}
				); */
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
					<div class="fsearch" style="">
						<table border="0" cellpadding="1" cellspacing="1">
							<tr>
								<td>Tahun&nbsp</td>
								<td><?=$this->rpt_penetapankl_model->getListTahun($objectId)?></td>
							</tr>
							<tr style="height:10px">
								<td style="">
								</td>
							</tr>
							<tr>
								<td colspan="2" align="right">
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
			<? if($this->sys_menu_model->cekAkses('PRINT;',256,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a 	href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
			<?}?>
			<? if($this->sys_menu_model->cekAkses('EXCEL;',256,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
				<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
			<?}?>
	  </div>
	</div>
	
	<table id="dg<?=$objectId;?>" class="easyui-datagrid" style="height:auto;width:auto" title="Laporan Penetapan Kinerja Kementerian" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="false" pagination="true" nowrap="false" showFooter="true">
		<thead>
		<tr>
			<th field="no" rowspan="2" sortable="false" width="25px">No.</th>
			<th field="sasaran_strategis"  rowspan="2"  sortable="false" width="200px">Sasaran Strategis</th>
			<th sortable="false" colspan="2" width="275px">Indikator Kinerja Utama</th>
			<th field="target" align="right" rowspan="2" sortable="false" width="75px">Target</th>
			<th field="satuan"  rowspan="2" sortable="false" width="125px">Satuan</th>
			<th field="program" rowspan="2" sortable="false" width="200px">Program & Anggaran</th>
		</tr>
		<tr>
			<th field="no_indikator" sortable="false" width="25px">No.</th>
			<th field="indikator_kinerja" sortable="false" width="250px">Deskripsi</th>
		</tr>
		</thead>  
	</table>
