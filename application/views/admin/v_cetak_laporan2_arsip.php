<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Laporan Rekapitulasi Cetak</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/laporan/laporan.css')?>"/>
</head>
<body onload="window.print()">
<?php
$uri3=$this->uri->segment(3);
$uri4=$this->uri->segment(4);
?>
<div id="laporan">
<table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:1px;margin-bottom:20px;">
<!--<tr>
    <td><img src="<?php// echo base_url().'assets/img/kop_surat.png'?>"/></td>
</tr>-->
</table>

<table border="0" align="center" style="width:800px; border:none;margin-top:1px;margin-bottom:0px;">
<tr>
    <?php
        $id_admin=$this->session->userdata('idadmin');
        $q=$this->db->query("SELECT * FROM tbl_admin WHERE pengguna_id='$id_admin'");
        $c=$q->row_array();
        ?>
    <td colspan="2" style="width:800px;paddin-left:20px;"><center><h4>USULAN Aduan <?php echo strtoupper($c['pengguna_nama']);?></h4></center></td>
    <hr width="63%">


</tr>
                       
</table>
<hr width="63%">

<table border="0" align="center" style="width:900px;border:none;">
   <tr>
      <th style="text-align:left"></th>
   </tr>
</table>

<table id="cetak_laporan" border="1" align="center" style="width:900px;margin-bottom:20px;">
<thead>
    <tr>
        <th style="width:50px;">No</th>
         <th>NAMA</th>
        <th>KOMISI</th>
        <th>NAMA USULAN</th>
        <th>RINCIAN USULAN</th>
        <th>LOKASI</th>
<!--         <th>Tanggal</th> -->
        <th>ANGGARAN (Rp)</th>

    </tr>
</thead>
<tbody id="tbody_cetak_laporan">
    <?php
    $no=0;
    foreach ($data->result_array() as $i) :
    $no++;
    $id=$i['id'];
    $id_kepada=$i['id_kepada'];
    $ditujukan_kepada=$i['ditujukan_kepada'];
    $judul=$i['judul_laporan'];
    $id_jenis=$i['id_jenis'];
    $isi_laporan=$i['isi_laporan'];
    $lokasi=$i['lokasi'];
    $xanggaran=$i['anggaran'];
    $anggaran = preg_replace("/[^0-9]/", "", $xanggaran);

    $nama=$i['nama'];
    $alamat=$i['alamat'];
    $hp=$i['hp'];
    $tanggal_laporan=$i['tanggal_laporan'];
    $laporan_status=$i['laporan_status'];
    $foto=$i['foto'];
    ?>
    <tr>
        <td style="text-align:center;"><?php echo $no;?></td>
        <td style="width:600px;padding-left:5px;"><?php echo $ditujukan_kepada;?></td>
        <td style="width:500px;padding-left:10px;"><?php echo $nama;?></td>
        <td style="width:1500px;padding-left:10px;"><?php echo $judul;?></td>

        <td style="width:2500px;"><?php echo $isi_laporan;?></td>
        <td style="width:1000px;"><?php echo $lokasi;?></td>

   <!--      <td style="width:300px;"><?php echo $tanggal_laporan;?></td> -->
        <td style="text-align:right;width:400px;"><?php echo number_format($anggaran);?></td>
   
    </tr>
               <?php endforeach;?>
</tbody>
<tfoot>
    <tr>

        <td colspan="6" style="text-align:center;"><b>Total</b></td>
        <td style="text-align:right;"><b><?php echo number_format($jml);?></b></td>

    </tr>
</tfoot>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="center">Wonosobo, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
   
    <tr>
    <td><br/><br/><br/><br/></td>
    </tr>    
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="center">( <?php echo $this->session->userdata('nama');?> )</td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <th><br/><br/></th>
    </tr>
    <tr>
        <th align="left"></th>
    </tr>
</table>
</div>
<!--     <script>
        window.print();
    </script> -->
    <script> //tabel periode laporan perulangan perulangan perulangan
   $(document).ready(function() {
            tampil_monev_air_minum();
            function tampil_monev_air_minum(){
                  $.ajax({
                      type  : 'GET',
                      url  : "<?php echo base_url('admin/laporan/cetak_komisi_json').$this->uri->segment(4);?>",
                      async : true,
                      dataType : 'json',
                      success : function(data){
                          var html = '';
                          var i;
                          var no=0;
                          for(i=0; i<data.length; i++){
                              var no = no+1;
                              html += '<tr>'+
                                    '<td>'+no+'</td>'+
                                      '<td>'+data[i].ditujukan_kepada+'</td>'+
                                      '<td>'+data[i].nama+'</td>'+
                                      '<td>'+data[i].judul+'</td>'+
                                      '<td>'+data[i].isi_laporan+'</td>'+
                                      '<td>'+data[i].lokasi+' Kecamatan '+data[i].kecamatan+'</td>'+
                                      '<td>'+data[i].tanggal_laporan+'</td>'+
                                      '<td class="project-actions" style="text-align:center;">'+
                                      '<a class="btn btn-primary btn-sm item_monev_air_minum" href="<?php echo base_url().'user/monev/edit_monev_air_minum/';?>'+data[i].id+'">Lengkapi</a>'+' '+
                                      // '<a class="btn btn-danger btn-xs item_monev_air_minum_hapus" data="'+data[i].id+'" data-toggle="modal" data-target="#modal-sarpras-hapus">Hapus</a>'+' '+
                                      '</td>'+
                                  '</tr>';
                          }
                              $('#tbody_tbl_monev_air_minum').html(html);
                              $('#tbody_tbl_monev_air_minum').refresh;
                              $('#tbl_monev_air_minum').refresh;
                              
                              
                      $('#tbl_monev_air_minum').DataTable({
                          "paging": true,
                          "lengthChange": true,
                          "searching": true,
                          "ordering": true,
                          "info": true,
                          "autoWidth": true
                          });
                      }

                  });
              }
            });
      </script>
</body>




</html>