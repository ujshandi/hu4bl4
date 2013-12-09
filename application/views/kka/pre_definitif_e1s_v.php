	<script  type="text/javascript" >
		$(function(){
			var url;
			newData<?=$objectId;?> = function (){  			
				addTab("Add Pra Definitif Eselon I","kka/pre_definitif_e1/add");
			}
			//end newData 
			
			editData<?=$objectId;?> = function (editmode){ 
				var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
				//alert(row.dokter_kode);
				if (row){
					if(editmode){
						if(row.status == '0'){
							addTab("Edit Pra Definitif Eselon I", "kka/pre_definitif_e1/edit/"+row.predefinitif_e1_id);
						}else{
							alert('Maaf data tidak bisa diedit, karena sudah ditetapkan di PK.');
						}
					}else{
						addTab("View Pra Definitif Eselon I", "kka/pre_definitif_e1/edit/"+row.predefinitif_e1_id+"/"+editmode);
					}
					
				}
			}
			
			deleteData<?=$objectId;?> = function (){
				<? if ($this->session->userdata('unit_kerja_e1')=='-1'){?>				
					var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
					if(row){
						if(confirm("Apakah yakin akan menghapus data '" + row.kode_iku_e1 + "'?")){
							var response = '';
							$.ajax({ type: "GET",
									 url: base_url+'kka/pre_definitif_e1/delete/' + row.predefinitif_e1_id,
									 async: false,
									 success : function(response)
									 {
										var response = eval('('+response+')');
										if (response.success){
											$.messager.show({
												title: 'Success',
												msg: 'Data Berhasil Dihapus'
											});
											
											// reload and close tab
											$('#dg<?=$objectId;?>').datagrid('reload');
										} else {
											$.messager.show({
												title: 'Error',
												msg: response.msg
											});
										}
									 }
							});
						}
					}
				<?} else { ?>	
					alert("Silahkan Login sebagai Superadmin");
				<?} ?>
			}
			//end deleteData			
			
			clearFilter<?=$objectId;?> = function (){
				$("#filter_tahun<?=$objectId;?>").val('');
				$("#filter_e1<?=$objectId;?>").val('');
				searchData<?=$objectId;?>();
			}
			
			//tipe 1=grid, 2=pdf, 3=excel
			getUrl<?=$objectId;?> = function (tipe){
				var filtahun = $("#filter_tahun<?=$objectId;?>").val();
					<? if ($this->session->userdata('unit_kerja_e1')==-1){?>
					var file1 = $("#filter_e1<?=$objectId;?>").val();
				<?} else {?>
					var file1 = "<?=$this->session->userdata('unit_kerja_e1');?>";
				<?}?>
				if(filtahun==null) filtahun ="-1";
				if (file1 == null) file1 = "-1";
			
				if (tipe==1){
					return "<?=base_url()?>kka/pre_definitif_e1/gridKegiatan/"+filtahun+"/"+file1;
				}
				else if (tipe==2){
					return "<?=base_url()?>kka/pre_definitif_e1/pdf/"+filtahun+"/"+file1;
				}else if (tipe==3){
					return "<?=base_url()?>kka/pre_definitif_e1/excel/"+filtahun+"/"+file1;
				}
			}
			
			searchData<?=$objectId;?> = function (){
				//ambil nilai-nilai filter
				$('#dg<?=$objectId;?>').datagrid({
					url:getUrl<?=$objectId;?>(1),
					queryParams:{lastNo:'0'},	
					pageNumber : 1,
					onClickCell: function(rowIndex, field, value){
					$('#dg<?=$objectId;?>').datagrid('selectRow', rowIndex);
					var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
					
					switch(field){
						case "kode_sasaran_e1":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_sasaran_e1);
							break;
						case "kode_iku":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_iku_e1);
							break;
						case "kode_e1":
							showPopup('#popdesc<?=$objectId?>', row.nama_e1);
							break;	
						case "kode_kegiatan":
							showPopup('#popdesc<?=$objectId?>', row.nama_kegiatan);
							break;
						default:
							closePopup('#popdesc<?=$objectId?>');
							break;
					}
				},
					onLoadSuccess:function(data){	
						$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						//prepareMerge<?=$objectId;?>(data);
				}});
			}
			//end searchData 
		
			printData<?=$objectId;?>=function(){			
				//$.jqURL.loc(getUrl<?=$objectId;?>(2),{w:800,h:600,wintype:"_blank"});
			//window.open(getUrl<?=$objectId;?>(2));;
				alert("Fungsi ini belum tersedia");
			}
			toExcel<?=$objectId;?>=function(){
				alert("Fungsi ini belum tersedia");
				//window.open(getUrl<?=$objectId;?>(3));;
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
				searchData<?=$objectId;?> ();
				//$('#dg<?=$objectId;?>').datagrid({url:"<?=base_url()?>kka/pre_definitif_e1/grid"});
			},50);
			
			
		
			$("#popdesc<?=$objectId?>").click(function(){
				closePopup('#popdesc<?=$objectId?>');
			});
			
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
		
		
		.datagrid-header .datagrid-cell{
			height:auto;
			line-height:auto;
		}
	</style>
	<div id="tb<?=$objectId;?>" style="height:auto">
	 <table border="0" cellpadding="1" cellspacing="1" width="100%">
		<tr>
			<td>
			<div class="fsearch"?>
				<table border="0" cellpadding="1" cellspacing="1">
				<tr>
					<td>Tahun :</td>
					<td>
					<?=$this->sasaran_eselon1_model->getListFilterTahun($objectId)?>
					</td>
					<td width="10px"></td>
					<td>
						<a href="#" class="easyui-linkbutton" onclick="searchData<?=$objectId;?>();" iconCls="icon-search">Search</a>
					</td>
				</tr>
				</table>
			</div>
			</td>
		</tr>
		</table>
	  <div style="margin-bottom:5px"> 
		<!--<? if($this->sys_menu_model->cekAkses('ADD;',64,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="newData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>  
		<?}?>
		<? if($this->sys_menu_model->cekAkses('EDIT;',64,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="editData<?=$objectId;?>(true);" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Edit</a>
		<?}?>
		
		<? if($this->sys_menu_model->cekAkses('VIEW;',64,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="editData<?=$objectId;?>(false);" class="easyui-linkbutton" iconCls="icon-view" plain="true">View</a>
		<?}?>-->
		<!--
		<? if($this->sys_menu_model->cekAkses('DELETE;',64,$this->session->userdata('group_id'),$this->session->userdata('level_id'))){?>
			<a href="#" onclick="deleteData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-remove" plain="true">Delete</a>
		<?}?> -->
		
		<a href="#" onclick="printData<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-print" plain="true">Print</a>
		<a href="#" onclick="toExcel<?=$objectId;?>();" class="easyui-linkbutton" iconCls="icon-excel" plain="true">Excel</a>
		
	  </div>
	</div>
	
	
<table id="dg<?=$objectId;?>" style="height:auto;width:auto" title="Data Kegiatan" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="true" pagination="true" nowrap="false">
	<thead>
	<tr>
		<th field="id_kegiatan_kl" sortable="true" width="5px" hidden="true">No.</th>
		<th field="tahun" sortable="true" width="10px">Tahun</th>
		<th field="kode_program" sortable="true" width="20px">Kode Program</th>
		<th field="nama_program" hidden="true">Nama Program</th>
		<th field="kode_kegiatan" sortable="true" width="20px">Kode Kegiatan</th>
		<th field="nama_kegiatan" sortable="true" width="75px">Nama Kegiatan</th>
		<th field="total" sortable="true" width="25px" align="right" formatter="formatPrice">Total Rencana <br>Anggaran (Rp)</th>
		<th field="total_kumulatif" sortable="true" width="25px" align="right" formatter="formatPrice">Akumulasi Anggaran<br> Sub Kegiatan (Rp)</th>
		<th field="kode_e2" sortable="true" width="20px"<?=($this->session->userdata('unit_kerja_e2')=='-1'?'':'hidden="true"')?>>Kode Bidang</th>
		<th field="nama_e2" hidden="true">Nama Eselon II</th>
	</tr>
	</thead>  
</table>


<script type="text/javascript">
        $(function(){
			var parentId;
			// chan
			$('#dg<?=$objectId;?>').datagrid({
				url:getUrl<?=$objectId;?>(1),	
				view: detailview,
				 detailFormatter:function(index,row){
                    return '<div style="padding:2px"><table id="ddv<?=$objectId;?>-' + index + '"></table></div>';
                //  return "tes";
                },
                onExpandRow: function(index,row){
				//	alert(row.id_pk_e1);

                    $('#ddv<?=$objectId;?>-'+index).datagrid({
                        url:'<?=base_url()?>kka/pre_definitif_e1/gridMonev/'+row.tahun+'/'+row.kode_kegiatan+'/?parentIndex='+index,
                        fitColumns:true,
                        singleSelect:true,
                        rownumbers:true,
						nowrap:false,
                        loadMsg:'',
                        height:'auto',		
                        columns:[[
                            {field:'predefinitif_e1_id',title:'id',hidden:true},
                            {field:'tahun',title:'Tahun',width:30},                            
                            {field:'deskripsi_sasaran_e1',title:'Deskripsi Sasaran',width:200},
                            {field:'deskripsi_iku_e1',title:'Deskripsi IKK',width:200},
                            {field:'kode_subkegiatan',title:'Kode',width:100},
                            {field:'nama_subkegiatan',title:'Kegiatan / Sub Kegiatan',width:200},
                            {field:'jumlah',title:'Jumlah',width:80,align:'right'}
                        ]],
                        onResize:function(){
                            $('#dg<?=$objectId;?>').datagrid('fixDetailRowHeight',index);
                        },
                       onClickCell:function(rowIndex, field, value){
							 $('#ddv<?=$objectId;?>-'+index).datagrid('selectRow', rowIndex);
							//var row = $('#ddv<?=$objectId;?>-'+index).datagrid('getSelected');
							//idCheckpoint<?=$objectId;?> = row.id_checkpoint_e1;
							//rowIndexDetail = index;
							//alert(idCheckpoint);
					   },
                        onLoadSuccess:function(){
                            setTimeout(function(){
                                $('#dg<?=$objectId;?>').datagrid('fixDetailRowHeight',index);
                            },0);
                        }
                    });
                    $('#dg<?=$objectId;?>').datagrid('fixDetailRowHeight',index);

	
                },
				onClickCell: function(rowIndex, field, value){
					$('#dg<?=$objectId;?>').datagrid('selectRow', rowIndex);
					//var row = $('#dg<?=$objectId;?>').datagrid('getSelected');
					//idCheckpoint<?=$objectId;?> = null;
					//alert(row.deskripsi_iku_e1);
					/* switch(field){
						case "kode_e1":
							showPopup('#popdesc<?=$objectId?>', row.nama_e1);
							break;
						case "kode_sasaran_e1":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_sasaran_e1);
							break;
						case "kode_iku_e1":
							showPopup('#popdesc<?=$objectId?>', row.deskripsi_iku_e1);
							break;
						
						default:
							closePopup('#popdesc<?=$objectId?>');
							break;
					} */
				}
			});
			
			
            ;
        });
    </script>
<!--	<table id="dg<?=$objectId;?>" style="height:auto;width:auto" title="Data Pre Definitif Eselon I" toolbar="#tb<?=$objectId;?>" fitColumns="true" singleSelect="true" rownumbers="true" pagination="true" noWrap="false">
	  <thead>
	  <tr>
		<th field="predefinitif_e1_id" sortable="true" hidden="true" width="50px">predefinitif_e1_id</th>
		<th field="tahun" sortable="true" width="20px">Tahun</th>
		<th field="kode_e1" sortable="true" width="20px"<?=($this->session->userdata('unit_kerja_e1')=='-1'?'':'hidden="true"')?>>Kode Unit Kerja</th>
		<th field="nama_e1" hidden="true">nama e1</th>
		<th field="kode_sasaran_e1" sortable="true" width="40px">Kode Sasaran</th>
		<th field="deskripsi_sasaran_e1" hidden="true">deskripsi_sasaran_e1</th>
		<th field="kode_iku" sortable="true" width="40px">Kode IKU</th>
		<th field="kode_kegiatan" sortable="true" width="50px">Kode Kegiatan</th>
		<th field="deskripsi_iku_e1" hidden="true">deskripsi_iku_e1</th>
		<th field="nama_kegiatan" sortable="true" width="250px">Kegiatan / Sub Kegiatan</th>
		<th field="jumlah" sortable="true" width="50px" align="right" formatter="formatPrice">Jumlah</th>
		
		
	  </tr>
	  </thead>  
	</table>
	-->
	<div class="popdesc" id="popdesc<?=$objectId?>">&nbsp;</div>