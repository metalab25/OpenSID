<script language="javascript" type="text/javascript">

	$(document).ready(function()
	{
	  $('#reset_form').on('click', function()
	  {
	  	$('#nomor').val('');
	  	$('#calon_pria').val('2');
	  	$('#calon_wanita').val('2');
	  });
	});

	function calon_wanita_asal(asal)
	{
		$('#calon_wanita').val(asal);
		if (asal == 1)
		{
			$('.wanita_desa').show();
			$('.wanita_luar_desa').hide();
			// Mungkin bug di jquery? Terpaksa hapus class radio button
			$('#label_calon_wanita_2').removeClass('active');
		}
		else
		{
			$('.wanita_desa').hide();
			$('.wanita_luar_desa').show();
		 	$('#id_wanita').val('*'); // Hapus $id_wanita
			submit_form_ambil_data_pria();
		}
	}

	function calon_pria_asal(asal)
	{
		$('#calon_pria').val(asal);
		if (asal == 1)
		{
			$('.pria_desa').show();
			$('.pria_luar_desa').hide();
			// Mungkin bug di jquery? Terpaksa hapus class radio button
			$('#label_calon_pria_2').removeClass('active');
		}
		else
		{
			$('.pria_desa').hide();
			$('.pria_luar_desa').show();
			$('#id_wanita_copy').val($('#id_wanita_hidden').val());
			$('#id_wanita_validasi').val($('#id_wanita_hidden').val());
			$('#id_pria').val('*'); // Hapus $id_pria
			submit_form_ambil_data_pria();
		}
	}

	function nomor_surat(nomor)
	{
		$('#nomor').val(nomor);
		$('#nomor_main').val(nomor);
	}

	function submit_form_ambil_data_pria(asal)
	{
	 	$('#id_wanita').val('*'); // Hapus $id_wanita
		$('#id_wanita_copy').val($('#id_wanita_hidden').val());
		$('input').removeClass('required');
		$('select').removeClass('required');
		$('#'+'main').attr('action','')
		$('#'+'main').attr('target','')
		$('#'+'main').submit();
	}

	function submit_form_ambil_data_wanita()
	{
		$('#id_wanita_validasi').val($('#id_wanita_hidden').val());
		$('input').removeClass('required');
		$('select').removeClass('required');
		$('#'+'validasi').attr('action','')
		$('#'+'validasi').attr('target','')
		$('#'+'validasi').submit();
	}

	function submit_form_doc()
	{
		if (($('#id_pria').val()=='' || $('#id_pria').val()=='*') && ($('#id_wanita').val()=='' || $('#id_wanita').val()=='*'))
		{
			$('#dialog').modal('show');

			return;
		}
		$('#'+'validasi').attr('action','<?= $form_action2?>');
		$('#'+'validasi').submit();
	}

	function status_beristri(status)
	{
		if (status.toUpperCase() == 'beristri'.toUpperCase())
		{
			$('#beristri').show();
		}
		else
		{
			$('#beristri').hide();
		}
	}

	function cerai_mati(status)
	{
		// Untuk calon wanita luar desa pilihan hanya 'perawan' atau 'janda'
		if (status.toUpperCase() == 'janda'.toUpperCase())
		{
			$('#cerai_mati').show();
		}
		else
		{
			$('#cerai_mati').hide();
		}
	}

</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Surat Keterangan Untuk Nikah</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_desa/about')?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?= site_url('surat')?>"> Daftar Cetak Surat</a></li>
			<li class="active">Surat Keterangan Untuk Nikah</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?=site_url("surat")?>" class="btn btn-social btn-flat btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Kembali Ke Daftar Wilayah">
							<i class="fa fa-arrow-circle-left "></i>Kembali Ke Daftar Cetak Surat
					 	</a>
					</div>
					<div class="box-body">
						<form action="" id="main" name="main" method="POST" class="form-horizontal">
							<div class="col-md-12">
								<div class="form-group">
									<label for="nomor"  class="col-sm-3 control-label">Nomor Surat</label>
									<div class="col-sm-8">
										<input  id="nomor" class="form-control input-sm required" type="text" placeholder="Nomor Surat" name="nomor" value="<?= $_SESSION['post']['nomor']; ?>" onchange="nomor_surat(this.value);">
										<p class="help-block text-red small">Terakhir: <strong><?= $surat_terakhir['no_surat'];?></strong> (tgl: <?= $surat_terakhir['tanggal']?>)</p>
									</div>
								</div>
								<?php $jenis_pasangan = "Istri"; ?>
								<div class="form-group subtitle_head">
									<label class="col-sm-3 control-label" for="status">A. CALON PASANGAN PRIA</label>
									<div class="btn-group col-sm-8" data-toggle="buttons">
										<label for="calon_pria_1" class="btn btn-info btn-flat btn-sm col-sm-4 col-sm-4 col-md-4 col-lg-3 form-check-label <?php if (!empty($pria)): ?>active<?php endif ?>">
											<input id="calon_pria_1" type="radio"  name="calon_pria" class="form-check-input" type="radio" value="1" <?php if (!empty($pria)): ?>checked<?php endif; ?> autocomplete="off" onchange="calon_pria_asal(this.value);"> Warga Desa
										</label>
										<label for="calon_pria_2" class="btn btn-info btn-flat btn-sm col-sm-4 col-md-4 col-lg-3 form-check-label <?php if (empty($pria)): ?>active<?php endif; ?>">
											<input id="calon_pria_2" type="radio"  name="calon_pria" class="form-check-input" type="radio" value="2" <?php if (empty($pria)): ?>checked<?php endif; ?> autocomplete="off" onchange="calon_pria_asal(this.value);"> Warga Luar Desa
										</label>
									</div>
								</div>
								<div class="form-group pria_desa" <?php if (empty($pria)): ?>style="display: none;"<?php endif; ?>>
									<label for="pria_desa"  class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:-10px;padding-top:10px;padding-bottom:10px"><strong>A.1 DATA CALON PASANGAN PRIA WARGA DESA</strong></label>
								</div>
								<div class="form-group pria_desa" <?php if (empty($pria)): ?>style="display: none;"<?php endif; ?>>
									<input id="nomor_main" name="nomor_main" type="hidden" value="<?= $nomor; ?>"/>
									<input id="calon_pria" name="calon_pria" type="hidden" value=""/>

									<label for="pria_desa" class="col-sm-3 control-label" ><strong>NIK / Nama :</strong></label>
									<div class="col-sm-5">
										<select class="form-control  input-sm select2" id="id_pria" name="id_pria" style ="width:100%;" onchange="submit_form_ambil_data_pria(this.id);">
											<option value="">--  Cari NIK / Nama--</option>
											<?php foreach ($laki as $data): ?>
												<option value="<?= $data['id']?>" <?php if ($pria['nik']==$data['nik']): ?>selected<?php endif; ?>>NIK :<?= $data['nik']." - ".$data['nama']?></option>
											<?php endforeach;?>
										</select>
									</div>
									<input id="calon_wanita" name="calon_wanita" type="hidden" value=""/>
									<!-- Diisi oleh script flexbox wanita -->
									<input id="id_wanita_copy" name="id_wanita" type="hidden" value="kosong"/>
								</div>
								<?php if ($pria): ?>
									<?php $individu = $pria;?>
									<?php include("donjo-app/views/surat/form/konfirmasi_pemohon.php"); ?>
								<?php	endif; ?>
							</div>
						</form>
						<form id="validasi" action="<?= $form_action?>" method="POST" target="_blank" class="form-horizontal">
							<div class="col-md-12">
								<input id="nomor" name="nomor" type="hidden" value="<?= $_SESSION['post']['nomor']; ?>"/>
								<input id="id_pria_validasi" type="hidden" name="id_pria" value="<?= $_SESSION['id_pria']?>">
								<input id="id_wanita" name="id_wanita" type="hidden" value="<?= $_SESSION['id_wanita']?>"/>
								<?php if (empty($pria)): ?>
									<div class="form-group pria_luar_desa" >
										<label for="pria_luar_desa"  class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:-10px;padding-top:10px;padding-bottom:10px"><strong>A.1 DATA CALON PASANGAN PRIA LUAR DESA</strong></label>
									</div>
									<div class="form-group pria_luar_desa">
										<label for="pria_luar_desa" class="col-sm-3 control-label" ><strong>Nama Lengkap</strong></label>
										<div class="col-sm-8">
											<input  name="nama_pria" class="form-control input-sm" type="text" placeholder="Nama Lengkap" value="<?= $_SESSION['post']['nama_pria']?>">
										</div>
									</div>
									<div class="form-group pria_luar_desa">
										<label for="tempatlahir_pria"  class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-5 col-lg-6">
											<input class="form-control input-sm" type="text" name="tempatlahir_pria" id="tempatlahir_pria" placeholder="Tempat Lahir" value="<?= $_SESSION['post']['tempatlahir_pria']?>">
										</div>
										<div class="col-sm-3 col-lg-2">
											<div class="input-group input-group-sm date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input title="Pilih Tanggal"  class="form-control datepicker input-sm" name="tanggallahir_pria" type="text" placeholder="Tgl. Lahir" value="<?= $_SESSION['post']['tanggallahir_pria']?>"/>
											</div>
										</div>
									</div>
									<div class="form-group pria_luar_desa">
										<label for="tempatlahir_pria"  class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" name="wn_pria" id="wn_pria" style ="width:100%;">
												<option value="">-- Pilih warganegara --</option>
												<?php foreach ($warganegara as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['wn_pria']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="agama_pria" id="agama_pria" style ="width:100%;">
												<option value="">-- Pilih Agama --</option>
												<?php foreach ($agama as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['agama_pria']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="pekerjaan_pria" id="pekerjaan_pria" style ="width:100%;">
												<option value="">-- Pekerjaan --</option>
												<?php foreach ($pekerjaan as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['pekerjaan_pria']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group pria_luar_desa">
										<label for="pria_luar_desa" class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input  name="alamat_pria" class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $_SESSION['post']['alamat_pria']?>">
										</div>
									</div>
									<div class="form-group pria_luar_desa">
										<label for="pria_luar_desa" class="col-sm-3 control-label" ><strong>Jika pria, terangkan jejaka, duda atau beristri</strong></label>
										<div class="col-sm-4">
											<select class="form-control input-sm select2 required" name="status_kawin_pria" id="status_kawin_pria" style ="width:100%;" onchange="status_beristri($(this).val())">
												<option value="">-- Pilih Status Kawin --</option>
												<?php foreach ($kode['status_kawin_pria'] as $data): ?>
													<option value="<?= $data?>" <?php if ($data['nama']==$_SESSION['post']['status_kawin_pria']): ?>selected<?php endif; ?>><?= ucwords($data)?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div id="beristri" class="form-group pria_luar_desa">
										<label for="pria_luar_desa" class="col-sm-3 control-label" ><strong>Jika beristri, berapa istrinya</strong></label>
										<div class="col-sm-4">
											<input  name="jumlah_istri" class="form-control input-sm" type="text" placeholder="Jumlah Istri" value="<?= $_SESSION['post']['jumlah_istri']?>">
										</div>
									</div>
								<?php endif; ?>
								<?php if ($pria): ?>
									<div class="form-group">
										<label for="status_kawin_pria" class="col-sm-3 control-label" ><strong>Jika pria, terangkan jejaka, duda atau beristri</strong></label>
										<div class="col-sm-4">
											<select class="form-control input-sm select2" disabled="disabled" style ="width:100%;">
												<option value="">-- Pilih Status Kawin --</option>
												<?php foreach ($kode['status_kawin_pria'] as $data): ?>
													<option value="<?= $data?>" <?php if ($pria['status_kawin_pria']==$data): ?>selected<?php endif; ?>><?= ucwords($data)?></option>
												<?php endforeach;?>
											</select>
										</div>
										<p class="help-block">(Status kawin: <?= $pria['status_kawin']?>)</p>
										<input type="hidden" name="status_kawin_pria" id="status_kawin_pria" value="<?= $pria['status_kawin_pria']?>">
									</div>
									<?php if ($pria['status_kawin']=="KAWIN"): ?>
										<div class="form-group">
											<label for="jumlah_istri" class="col-sm-3 control-label" ><strong>Jika beristri, berapa istrinya</strong></label>
											<div class="col-sm-4">
												<input  name="jumlah_istri" class="form-control input-sm required" type="text" placeholder="Jumlah Istri" value="1">
											</div>
										</div>
									<?php endif; ?>
								<?php endif; ?>
								<?php if ($ayah_pria): ?>
									<div class="form-group" >
										<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="padding-top:10px;padding-bottom:10px"><strong>A.2 DATA AYAH PASANGAN PRIA</strong></label>
									</div>
									<div class="form-group">
										<label for="pria_luar_desa" class="col-sm-3 control-label" ><strong>Nama Lengkap</strong></label>
										<div class="col-sm-8">
											<input  class="form-control input-sm" type="text" placeholder="Nama Lengkap" value="<?= $ayah_pria['nama']?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label for="tempatlahir_pria"  class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-8">
											<input class="form-control input-sm" type="text" placeholder="Tempat Lahir" value="<?= $ayah_pria['tempatlahir']." / ".tgl_indo_out($ayah_pria['tanggallahir'])?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label for="tempatlahir_pria"  class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<input class="form-control input-sm" type="text" placeholder="Warganegara" value="<?= $ayah_pria['wn']?>" disabled>
										</div>
										<div class="col-sm-3">
											<input class="form-control input-sm" type="text" placeholder="Agama" value="<?= $ayah_pria['agama']?>" disabled>
										</div>
										<div class="col-sm-3">
											<input class="form-control input-sm" type="text" placeholder="Pekerjaan" value="<?= $ayah_pria['pek']?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input  class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $ayah_pria['alamat_wilayah']?>">
										</div>
									</div>
								<?php else: ?>
									<div class="form-group ayah_pria" >
										<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>A.2 DATA AYAH PASANGAN PRIA (Isi jika ayah bukan warga <?= strtolower($this->setting->sebutan_desa)?> ini ini)</strong></label>
									</div>
									<div class="form-group ayah_pria">
										<label class="col-sm-3 control-label" ><strong>Nama Lengkap</strong></label>
										<div class="col-sm-8">
											<input  name="nama_ayah_pria" class="form-control input-sm" type="text" placeholder="Nama Lengkap" value="<?= $_SESSION['post']['nama_ayah_pria']?>">
										</div>
									</div>
									<div class="form-group ayah_pria">
										<label class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-5 col-lg-6">
											<input class="form-control input-sm" type="text" name="tempatlahir_ayah_pria" id="tempatlahir_ayah_pria" placeholder="Tempat Lahir" value="<?= $_SESSION['post']['tempatlahir_ayah_pria']?>">
										</div>
										<div class="col-sm-3 col-lg-2">
											<div class="input-group input-group-sm date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input title="Pilih Tanggal"  class="form-control input-sm datepicker" name="tanggallahir_ayah_pria" type="text" placeholder="Tgl. Lahir" value="<?= $_SESSION['post']['tanggallahir_ayah_pria']?>"/>
											</div>
										</div>
									</div>
									<div class="form-group ayah_pria">
										<label class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" name="wn_ayah_pria" id="wn_ayah_pria" style ="width:100%;">
												<option value="">-- Pilih warganegara --</option>
												<?php foreach ($warganegara as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['wn_ayah_pria']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="agama_ayah_pria" id="agama_ayah_pria" style ="width:100%;">
												<option value="">-- Pilih Agama --</option>
												<?php foreach ($agama as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['agama_ayah_pria']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="pekerjaan_ayah_pria" id="pekerjaan_ayah_pria" style ="width:100%;">
												<option value="">-- Pekerjaan --</option>
												<?php foreach ($pekerjaan as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['pekerjaan_ayah_pria']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group ayah_pria">
										<label class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input  name="alamat_ayah_pria" class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $_SESSION['post']['alamat_ayah_pria']?>">
										</div>
									</div>
								<?php endif; ?>
								<?php if ($ibu_pria): ?>
									<div class="form-group" >
										<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="padding-top:10px;padding-bottom:10px"><strong>A.3 DATA IBU PASANGAN PRIA</strong></label>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><strong>Nama Lengkap</strong></label>
										<div class="col-sm-8">
											<input  class="form-control input-sm" type="text" placeholder="Nama Lengkap" value="<?= $ibu_pria['nama']?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label for="tempatlahir_pria"  class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-8">
											<input class="form-control input-sm" type="text" placeholder="Tempat Lahir" value="<?= $ibu_pria['tempatlahir']." / ".tgl_indo_out($ibu_pria['tanggallahir'])?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label for="tempatlahir_pria"  class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<input class="form-control input-sm" type="text" placeholder="Warganegara" value="<?= $ibu_pria['wn']?>" disabled>
										</div>
										<div class="col-sm-3">
											<input class="form-control input-sm" type="text" placeholder="Agama" value="<?= $ibu_pria['agama']?>" disabled>
										</div>
										<div class="col-sm-3">
											<input class="form-control input-sm" type="text" placeholder="Pekerjaan" value="<?= $ibu_pria['pek']?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input  class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $ibu_pria['alamat_wilayah']?>">
										</div>
									</div>
								<?php else: ?>
									<div class="form-group ibu_pria" >
										<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>A.3 DATA IBU PASANGAN PRIA (Isi jika ibu bukan warga <?= strtolower($this->setting->sebutan_desa)?> ini)</strong></label>
									</div>
									<div class="form-group ibu_pria">
										<label class="col-sm-3 control-label" ><strong>Nama Lengkap</strong></label>
										<div class="col-sm-8">
											<input  name="nama_ibu_pria" class="form-control input-sm" type="text" placeholder="Nama Lengkap" value="<?= $_SESSION['post']['nama_ibu_pria']?>">
										</div>
									</div>
									<div class="form-group ibu_pria">
										<label class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-5 col-lg-6">
											<input class="form-control input-sm" type="text" name="tempatlahir_ibu_pria" id="tempatlahir_ibu_pria" placeholder="Tempat Lahir" value="<?= $_SESSION['post']['tempatlahir_ibu_pria']?>">
										</div>
										<div class="col-sm-3 col-lg-2">
											<div class="input-group input-group-sm date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input title="Pilih Tanggal"  class="form-control input-sm datepicker" name="tanggallahir_ibu_pria" type="text" placeholder="Tgl. Lahir" value="<?= $_SESSION['post']['tanggallahir_ibu_pria']?>"/>
											</div>
										</div>
									</div>
									<div class="form-group ibu_pria">
										<label class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" name="wn_ibu_pria" id="wn_ibu_pria" style ="width:100%;">
												<option value="">-- Pilih warganegara --</option>
												<?php foreach ($warganegara as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['wn_ibu_pria']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="agama_ibu_pria" id="agama_ibu_pria" style ="width:100%;">
												<option value="">-- Pilih Agama --</option>
												<?php foreach ($agama as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['agama_ibu_pria']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="pekerjaan_ibu_pria" id="pekerjaan_ibu_pria" style ="width:100%;">
												<option value="">-- Pekerjaan --</option>
												<?php foreach ($pekerjaan as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['pekerjaan_ibu_pria']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group ibu_pria">
										<label class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input name="alamat_ibu_pria" class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $_SESSION['post']['alamat_ibu_pria']?>">
										</div>
									</div>
								<?php endif; ?>
								<?php if (empty($pria) OR $pria['status_kawin']=="CERAI MATI"): ?>
									<div class="form-group" >
											<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>A.4 DATA ISTRI TERDAHULU </strong></label>
										</div>
										<div class="form-group istri_dulu">
											<label class="col-sm-3 control-label" ><strong>Nama <?= ucwords($jenis_pasangan)?> Terdahulu / Binti</strong></label>
											<div class="col-sm-3">
												<input name="istri_dulu" class="form-control input-sm" type="text" placeholder="Nama Istri Terdahulu" value="<?= $_SESSION['post']['istri_dulu']?>">
											</div>
											<div class="col-sm-3">
												<input name="binti" class="form-control input-sm" type="text" placeholder="Binti" value="<?= $_SESSION['post']['binti']?>">
											</div>
									</div>
									<div class="form-group istri_dulu">
										<label class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-5 col-lg-6">
											<input class="form-control input-sm" type="text" name="tempatlahir_istri_dulu" id="tempatlahir_istri_dulu" placeholder="Tempat Lahir" value="<?= $_SESSION['post']['tempatlahir_istri_dulu']?>">
										</div>
										<div class="col-sm-3 col-lg-2">
											<div class="input-group input-group-sm date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input title="Pilih Tanggal"  class="form-control input-sm datepicker" name="tanggallahir_istri_dulu" type="text" placeholder="Tgl. Lahir" value="<?= $_SESSION['post']['tanggallahir_istri_dulu']?>"/>
											</div>
										</div>
									</div>
									<div class="form-group istri_dulu">
										<label class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" name="wn_istri_dulu" id="wn_istri_dulu" style ="width:100%;">
												<option value="">-- Pilih warganegara --</option>
												<?php foreach ($warganegara as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['wn_istri_dulu']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="agama_istri_dulu" id="agama_istri_dulu" style ="width:100%;">
												<option value="">-- Pilih Agama --</option>
												<?php foreach ($agama as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['agama_istri_dulu']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="pek_istri_dulu" id="pek_istri_dulu" style ="width:100%;">
												<option value="">-- Pekerjaan --</option>
												<?php foreach ($pekerjaan as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['pek_istri_dulu']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group istri_dulu">
										<label class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input name="alamat_istri_dulu" class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $_SESSION['post']['alamat_istri_dulu']?>">
										</div>
									</div>
									<div class="form-group istri_dulu">
										<label class="col-sm-3 control-label" ><strong>Keterangan <?= ucwords($jenis_pasangan)?> Dulu</strong></label>
										<div class="col-sm-8">
											<textarea name="ket_istri_dulu" class="form-control input-sm" placeholder="Keterangan" ><?= $_SESSION['post']['ket_istri_dulu']?></textarea>
										</div>
									</div>
								<?php endif; ?>
								<!-- CALON PASANGAN WANITA -->
								<?php $jenis_pasangan = "Suami"; ?>
								<div class="form-group subtitle_head">
									<label class="col-sm-3 control-label" for="status">B. CALON PASANGAN WANITA</label>
									<div class="btn-group col-sm-8" data-toggle="buttons">
										<label for="calon_wanita_1" class="btn btn-info btn-flat btn-sm col-sm-4 col-sm-4 col-md-4 col-lg-3 form-check-label <?php if (!empty($wanita)): ?>active<?php endif ?>">
											<input id="calon_wanita_1" type="radio"  name="calon_wanita" class="form-check-input" type="radio" value="1" <?php if (!empty($wanita)): ?>checked<?php endif; ?> autocomplete="off" onchange="calon_wanita_asal(this.value);"> Warga Desa
										</label>
										<label id="label_calon_wanita_2" for="calon_wanita_2" class="btn btn-info btn-flat btn-sm col-sm-4 col-md-4 col-lg-3 form-check-label <?php if (empty($wanita)): ?>active<?php endif; ?>">
											<input id="calon_wanita_2" type="radio"  name="calon_wanita" class="form-check-input" type="radio" value="2" <?php if (empty($wanita)): ?>checked<?php endif; ?> autocomplete="off" onchange="calon_wanita_asal(this.value);"> Warga Luar Desa
										</label>
									</div>
								</div>
								<div class="form-group wanita_desa" <?php if (empty($wanita)): ?>style="display: none;"<?php endif; ?>>
									<label for="wanita_desa" class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:-10px;padding-top:10px;padding-bottom:10px"><strong>B.1 DATA CALON PASANGAN WANITA WARGA DESA</strong></label>
								</div>
								<div class="form-group wanita_desa" <?php if (empty($wanita)): ?>style="display: none;"<?php endif; ?>>
									<label for="$wanita" class="col-sm-3 control-label" ><strong>NIK / Nama :</strong></label>
									<div class="col-sm-5">
										<select class="form-control  input-sm select2" id="id_wanita" name="id_wanita" style ="width:100%;"  onchange="submit_form_ambil_data_wanita(this.id);">
											<option value="">--  Cari NIK / Nama--</option>
											<?php foreach ($perempuan as $data): ?>
												<option value="<?= $data['id']?>" <?php if ($wanita['nik']==$data['nik']): ?>selected<?php endif; ?>>NIK : <?= $data['nik']." - ".$data['nama']?></option>
											<?php endforeach;?>
										</select>
									</div>
								</div>
								<?php if ($wanita): ?>
									<?php if ($wanita): //bagian info setelah terpilih
										$individu = $wanita;
										include("donjo-app/views/surat/form/konfirmasi_pemohon.php");
									endif; ?>
									<div class="form-group">
										<label for="status_kawin_pria" class="col-sm-3 control-label" ><strong>Jika wanita, terangkan perawan atau janda</strong></label>
										<div class="col-sm-4">
											<select class="form-control input-sm select2 required" style ="width:100%;" disabled="disabled">
												<option value="">-- Pilih Status Kawin --</option>
												<?php foreach ($kode['status_kawin_wanita'] as $data): ?>
													<option value="<?= $data?>" <?php if ($wanita['status_kawin_wanita']==$data): ?>selected<?php endif; ?>><?= ucwords($data)?></option>
												<?php endforeach;?>
											</select>
										</div>
										<p class="help-block">(Status kawin: <?= $wanita['status_kawin']?>)</p>
										<input type="hidden" name="status_kawin_wanita" id="status_kawin_wanita" value="<?= $wanita['status_kawin_wanita']?>">
									</div>
								<?php endif; ?>
								<?php if (empty($wanita)): ?>
									<div class="form-group wanita_luar_desa" >
										<label for="wanita_luar_desa"  class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:-10px;padding-top:10px;padding-bottom:10px"><strong>B.1 DATA CALON PASANGAN WANITA LUAR DESA</strong></label>
									</div>
									<div class="form-group wanita_luar_desa">
										<label for="wanita_luar_desa" class="col-sm-3 control-label" ><strong>Nama Lengkap</strong></label>
										<div class="col-sm-8">
											<input  name="nama_wanita" class="form-control input-sm" type="text" placeholder="Nama Lengkap" value="<?= $_SESSION['post']['nama_wanita']?>">
										</div>
									</div>
									<div class="form-group wanita_luar_desa">
										<label for="tempatlahir_wanita"  class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-5 col-lg-6">
											<input class="form-control input-sm" type="text" name="tempatlahir_wanita" id="tempatlahir_wanita" placeholder="Tempat Lahir" value="<?= $_SESSION['post']['tempatlahir_wanita']?>">
										</div>
										<div class="col-sm-3 col-lg-2">
											<div class="input-group input-group-sm date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input title="Pilih Tanggal"  class="form-control input-sm datepicker" name="tanggallahir_wanita" type="text" placeholder="Tgl. Lahir" value="<?= $_SESSION['post']['tanggallahir_wanita']?>"/>
											</div>
										</div>
									</div>
									<div class="form-group wanita_luar_desa">
										<label for="tempatlahir_wanita"  class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" name="wn_wanita" id="wn_wanita" style ="width:100%;">
												<option value="">-- Pilih warganegara --</option>
												<?php foreach ($warganegara as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['wn_wanita']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="agama_wanita" id="agama_wanita" style ="width:100%;">
												<option value="">-- Pilih Agama --</option>
												<?php foreach ($agama as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['agama_wanita']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="pekerjaan_wanita" id="pekerjaan_wanita" style ="width:100%;">
												<option value="">-- Pekerjaan --</option>
												<?php foreach ($pekerjaan as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['pekerjaan_wanita']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group wanita_luar_desa">
										<label for="wanita_luar_desa" class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input  name="alamat_wanita" class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $_SESSION['post']['alamat_wanita']?>">
										</div>
									</div>
									<div class="form-group wanita_luar_desa">
										<label for="wanita_luar_desa" class="col-sm-3 control-label" ><strong>Jika wanita, terangkan perawan atau janda</strong></label>
										<div class="col-sm-4">
											<select class="form-control input-sm select2" name="status_kawin_wanita" id="status_kawin_wanita" onchange="cerai_mati($(this).val())" style ="width:100%;">
												<option value="">-- Pilih Status Kawin --</option>
												<?php foreach ($kode['status_kawin_wanita'] as $data): ?>
													<option value="<?= $data?>" <?php if ($data['nama']==$_SESSION['post']['status_kawin_wanita']): ?>selected<?php endif; ?>><?= ucwords($data)?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
								<?php endif; ?>
								<?php if ($ayah_wanita): ?>
									<div class="form-group" >
										<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>B.2 DATA AYAH PASANGAN WANITA</strong></label>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><strong>Nama Lengkap</strong></label>
										<div class="col-sm-8">
											<input  class="form-control input-sm" type="text" placeholder="Nama Lengkap" value="<?= $ayah_wanita['nama']?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label for="tempatlahir_pria"  class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-8">
											<input class="form-control input-sm" type="text" placeholder="Tempat Lahir" value="<?= $ayah_wanita['tempatlahir']." / ".tgl_indo_out($ayah_wanita['tanggallahir'])?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label for="tempatlahir_pria"  class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<input class="form-control input-sm" type="text" placeholder="Warganegara" value="<?= $ayah_wanita['wn']?>" disabled>
										</div>
										<div class="col-sm-3">
											<input class="form-control input-sm" type="text" placeholder="Agama" value="<?= $ayah_wanita['agama']?>" disabled>
										</div>
										<div class="col-sm-3">
											<input class="form-control input-sm" type="text" placeholder="Pekerjaan" value="<?= $ayah_wanita['pek']?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input  class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $ayah_wanita['alamat_wilayah']?>">
										</div>
									</div>
								<?php else: ?>
									<div class="form-group ayah_wanita" >
										<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>B.2 DATA AYAH PASANGAN WANITA (Isi jika ayah bukan warga <?= strtolower($this->setting->sebutan_desa)?> ini)</strong></label>
									</div>
									<div class="form-group ayah_wanita">
										<label class="col-sm-3 control-label" ><strong>Nama Lengkap</strong></label>
										<div class="col-sm-8">
											<input  name="nama_ayah_wanita" class="form-control input-sm" type="text" placeholder="Nama Lengkap" value="<?= $_SESSION['post']['nama_ayah_wanita']?>">
										</div>
									</div>
									<div class="form-group ayah_wanita">
										<label class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-5 col-lg-6">
											<input class="form-control input-sm" type="text" name="tempatlahir_ayah_wanita" id="tempatlahir_ayah_wanita" placeholder="Tempat Lahir" value="<?= $_SESSION['post']['tempatlahir_ayah_wanita']?>">
										</div>
										<div class="col-sm-3 col-lg-2">
											<div class="input-group input-group-sm date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input title="Pilih Tanggal"  class="form-control input-sm datepicker" name="tanggallahir_ayah_wanita" type="text" placeholder="Tgl. Lahir" value="<?= $_SESSION['post']['tanggallahir_ayah_wanita']?>"/>
											</div>
										</div>
									</div>
									<div class="form-group ayah_wanita">
										<label class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" name="wn_ayah_wanita" id="wn_ayah_wanita" style ="width:100%;">
												<option value="">-- Pilih warganegara --</option>
												<?php foreach ($warganegara as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['wn_ayah_wanita']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="agama_ayah_wanita" id="agama_ayah_wanita" style ="width:100%;">
												<option value="">-- Pilih Agama --</option>
												<?php foreach ($agama as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['agama_ayah_wanita']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="pekerjaan_ayah_wanita" id="pekerjaan_ayah_wanita" style ="width:100%;">
												<option value="">-- Pekerjaan --</option>
												<?php foreach ($pekerjaan as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['pekerjaan_ayah_wanita']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group ayah_wanita">
										<label class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input  name="alamat_ayah_wanita" class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $_SESSION['post']['alamat_ayah_wanita']?>">
										</div>
									</div>
								<?php endif; ?>
								<?php if ($ibu_wanita): ?>
									<div class="form-group" >
										<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="padding-top:10px;padding-bottom:10px"><strong>B.3 DATA IBU PASANGAN WANITA</strong></label>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><strong>Nama Lengkap</strong></label>
										<div class="col-sm-8">
											<input  class="form-control input-sm" type="text" placeholder="Nama Lengkap" value="<?= $ibu_wanita['nama']?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label for="tempatlahir_pria"  class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-8">
											<input class="form-control input-sm" type="text" placeholder="Tempat Lahir" value="<?= $ibu_wanita['tempatlahir']." / ".tgl_indo_out($ibu_pria['tanggallahir'])?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label for="tempatlahir_pria"  class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<input class="form-control input-sm" type="text" placeholder="Warganegara" value="<?= $ibu_wanita['wn']?>" disabled>
										</div>
										<div class="col-sm-3">
											<input class="form-control input-sm" type="text" placeholder="Agama" value="<?= $ibu_wanita['agama']?>" disabled>
										</div>
										<div class="col-sm-3">
											<input class="form-control input-sm" type="text" placeholder="Pekerjaan" value="<?= $ibu_wanita['pek']?>" disabled>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input  class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $ibu_wanita['alamat_wilayah']?>">
										</div>
									</div>
								<?php else: ?>
									<div class="form-group ibu_wanita" >
										<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>B.3 DATA IBU PASANGAN WANITA (Isi jika ibu bukan warga <?= strtolower($this->setting->sebutan_desa)?> ini)</strong></label>
									</div>
									<div class="form-group ibu_wanita">
										<label class="col-sm-3 control-label" ><strong>Nama Lengkap</strong></label>
										<div class="col-sm-8">
											<input  name="nama_ibu_wanita" class="form-control input-sm" type="text" placeholder="Nama Lengkap" value="<?= $_SESSION['post']['nama_ibu_wanita']?>">
										</div>
									</div>
									<div class="form-group  ibu_wanita">
										<label class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-5 col-lg-6">
											<input class="form-control input-sm" type="text" name="tempatlahir_ibu_wanita" id="tempatlahir_ibu_wanita" placeholder="Tempat Lahir" value="<?= $_SESSION['post']['tempatlahir_ibu_wanita']?>">
										</div>
										<div class="col-sm-3 col-lg-2">
											<div class="input-group input-group-sm date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input title="Pilih Tanggal"  class="form-control input-sm datepicker" name="tanggallahir_ibu_wanita" type="text" placeholder="Tgl. Lahir" value="<?= $_SESSION['post']['tanggallahir_ibu_wanita']?>"/>
											</div>
										</div>
									</div>
									<div class="form-group ibu_wanita">
										<label class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" name="wn_ibu_wanita" id="wn_ibu_wanita" style ="width:100%;">
												<option value="">-- Pilih warganegara --</option>
												<?php foreach ($warganegara as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['wn_ibu_wanita']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="agama_ibu_wanita" id="agama_ibu_wanita" style ="width:100%;">
												<option value="">-- Pilih Agama --</option>
												<?php foreach ($agama as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['agama_ibu_wanita']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="pekerjaan_ibu_wanita" id="pekerjaan_ibu_wanita" style ="width:100%;">
												<option value="">-- Pekerjaan --</option>
												<?php foreach ($pekerjaan as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['pekerjaan_ibu_wanita']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group ibu_wanita">
										<label class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input name="alamat_ibu_wanita" class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $_SESSION['post']['alamat_ibu_wanita']?>">
										</div>
									</div>
								<?php endif; ?>
								<?php if (empty($wanita) OR strtolower($wanita['status_kawin'])=="cerai mati"): ?>
									<div id="cerai_mati" class="form-group" >
											<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>B.4 DATA SUAMI TERDAHULU </strong></label>
										</div>
										<div class="form-group suami_dulu">
											<label class="col-sm-3 control-label" ><strong>Nama <?= ucwords($jenis_pasangan)?> Terdahulu / Bin</strong></label>
											<div class="col-sm-3">
												<input name="nama_suami_dulu" class="form-control input-sm" type="text" placeholder="Nama Suami Terdahulu" value="<?= $_SESSION['post']['nama_suami_dulu']?>">
											</div>
											<div class="col-sm-3">
												<input name="bin_suami_dulu" class="form-control input-sm" type="text" placeholder="Bin" value="<?= $_SESSION['post']['binti_suami_dulu']?>">
											</div>
									</div>
									<div class="form-group suami_dulu">
										<label class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
										<div class="col-sm-5 col-lg-6">
											<input class="form-control input-sm" type="text" name="tempatlahir_suami_dulu" id="tempatlahir_suami_dulu" placeholder="Tempat Lahir" value="<?= $_SESSION['post']['tempatlahir_suami_dulu']?>">
										</div>
										<div class="col-sm-3 col-lg-2">
											<div class="input-group input-group-sm date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input title="Pilih Tanggal"  class="form-control input-sm datepicker" name="tanggallahir_suami_dulu" type="text" placeholder="Tgl. Lahir" value="<?= $_SESSION['post']['tanggallahir_suami_dulu']?>"/>
											</div>
										</div>
									</div>
									<div class="form-group suami_dulu">
										<label class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" name="wn_suami_dulu" id="wn_suami_dulu" style ="width:100%;">
												<option value="">-- Pilih warganegara --</option>
												<?php foreach ($warganegara as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['wn_suami_dulu']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="agama_suami_dulu" id="agama_suami_dulu" style ="width:100%;">
												<option value="">-- Pilih Agama --</option>
												<?php foreach ($agama as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['agama_suami_dulu']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control input-sm select2" name="pek_suami_dulu" id="pek_suami_dulu" style ="width:100%;">
												<option value="">-- Pekerjaan --</option>
												<?php foreach ($pekerjaan as $data): ?>
													<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['pek_suami_dulu']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group suami_dulu">
										<label class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
										<div class="col-sm-8">
											<input name="alamat_suami_dulu" class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $_SESSION['post']['alamat_suami_dulu']?>">
										</div>
									</div>
									<div class="form-group suami_dulu">
										<label class="col-sm-3 control-label" ><strong>Keterangan <?= ucwords($jenis_pasangan)?> Dulu</strong></label>
										<div class="col-sm-8">
											<textarea name="ket_suami_dulu" class="form-control input-sm" placeholder="Keterangan" ><?= $_SESSION['post']['ket_suami_dulu']?></textarea>
										</div>
									</div>
								<?php endif; ?>
								<div class="form-group" >
									<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>B.5 DATA WALI NIKAH </strong></label>
								</div>
								<div class="form-group wali">
									<label class="col-sm-3 control-label" ><strong>Nama Wali Nikah / Bin</strong></label>
									<div class="col-sm-3">
										<input name="nama_wali" class="form-control input-sm" type="text" placeholder="Nama Wali Nikah" value="<?= $_SESSION['post']['nama_wali']?>">
									</div>
									<div class="col-sm-3">
										<input name="bin_wali" class="form-control input-sm" type="text" placeholder="Bin" value="<?= $_SESSION['post']['bin_wali']?>">
									</div>
								</div>
								<div class="form-group wali">
									<label class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
									<div class="col-sm-5 col-lg-6">
										<input class="form-control input-sm" type="text" name="tempatlahir_wali" id="tempatlahir_wali" placeholder="Tempat Lahir" value="<?= $_SESSION['post']['tempatlahir_wali']?>">
									</div>
									<div class="col-sm-3 col-lg-2">
										<div class="input-group input-group-sm date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input title="Pilih Tanggal"  class="form-control input-sm datepicker" name="tanggallahir_wali" type="text" placeholder="Tgl. Lahir" value="<?= $_SESSION['post']['tanggallahir_wali']?>"/>
										</div>
									</div>
								</div>
								<div class="form-group wali">
									<label class="col-sm-3 control-label">Warganegara / Agama / Pekerjaan</label>
									<div class="col-sm-2">
										<select class="form-control input-sm select2" name="wn_wali" id="wn_wali" style ="width:100%;">
											<option value="">-- Pilih warganegara --</option>
											<?php foreach ($warganegara as $data): ?>
												<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['wn_wali']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
											<?php endforeach;?>
										</select>
									</div>
									<div class="col-sm-3">
										<select class="form-control input-sm select2" name="agama_wali" id="agama_wali" style ="width:100%;">
											<option value="">-- Pilih Agama --</option>
											<?php foreach ($agama as $data): ?>
												<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['agama_wali']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
											<?php endforeach;?>
										</select>
									</div>
									<div class="col-sm-3">
										<select class="form-control input-sm select2" name="pek_wali" id="pek_wali" style ="width:100%;">
											<option value="">-- Pekerjaan --</option>
											<?php foreach ($pekerjaan as $data): ?>
												<option value="<?= $data['nama']?>" <?php if ($data['nama']==$_SESSION['post']['pek_wali']): ?>selected<?php endif; ?>><?= $data['nama']?></option>
											<?php endforeach;?>
										</select>
									</div>
								</div>
								<div class="form-group wali">
									<label class="col-sm-3 control-label" ><strong>Tempat Tinggal</strong></label>
									<div class="col-sm-8">
										<input name="alamat_wali" class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $_SESSION['post']['alamat_wali']?>">
									</div>
								</div>
								<div class="form-group wali">
									<label class="col-sm-3 control-label" ><strong>Hubungan Dengan Wali</strong></label>
									<div class="col-sm-8">
										<input name="hub_wali" class="form-control input-sm" type="text" placeholder="Tempat Tinggal" value="<?= $_SESSION['post']['hub_wali']?>">
									</div>
								</div>
								<div class="form-group" >
									<label class="col-xs-12 col-sm-3 col-lg-3 control-label bg-maroon" style="margin-top:10px;padding-top:10px;padding-bottom:10px"><strong>C. DATA PERNIKAHAN </strong></label>
								</div>
								<div class="form-group wali">
									<label class="col-sm-3 control-label">Hari, Tanggal, Jam</label>
									<div class="col-sm-3 col-lg-4">
										<input class="form-control input-sm required" type="text" name="hari_nikah" id="hari_nikah" placeholder="Hari Nikah" value="<?= $_SESSION['post']['hari_nikah']?>">
									</div>
									<div class="col-sm-3 col-lg-2">
										<div class="input-group input-group-sm date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input title="Pilih Tanggal"  class="form-control input-sm datepicker required" name="tanggal_nikah" type="text" placeholder="Tgl. Nikah" value="<?= $_SESSION['post']['tanggal_nikah']?>"/>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="input-group input-group-sm date">
											<div class="input-group-addon">
												<i class="fa fa-clock-o"></i>
											</div>
											<input class="form-control input-sm required" name="jam_nikah" id="jammenit_1" type="text" placeholder="Jam Nikah" value="<?= $_SESSION['post']['jam_nikah']?>"/>
										</div>
									</div>
								</div>
								<div class="form-group wali">
									<label class="col-sm-3 control-label" ><strong>Mas Kawin</strong></label>
									<div class="col-sm-8">
										<input name="mas_kawin" class="form-control input-sm required" type="text" placeholder="Mas Kawin" value="<?= $_SESSION['post']['mas_kawin']?>">
									</div>
								</div>
								<div class="form-group wali">
									<label class="col-sm-3 control-label" ><strong>Tunai / Hutang</strong></label>
									<div class="col-sm-8">
										<input name="tunai" class="form-control input-sm required" type="text" placeholder="Tunai / Hutang" value="<?= $_SESSION['post']['tunai']?>">
									</div>
								</div>
								<div class="form-group wali">
									<label class="col-sm-3 control-label" ><strong>Tempat</strong></label>
									<div class="col-sm-8">
										<input name="tempat_nikah" class="form-control input-sm required" type="text" placeholder="Tempat" value="<?= $_SESSION['post']['tempat_nikah']?>">
									</div>
								</div>
								<?php include("donjo-app/views/surat/form/_pamong.php"); ?>
							</div>
						</form>
					</div>
					<div class="box-footer">
						<div class="row">
							<div class="col-xs-12">
								<button id="reset_form" type="reset" class="btn btn-social btn-flat btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
								<?php if (SuratCetak($url)): ?>
									<button type="button" onclick="$('#'+'validasi').attr('action','<?= $form_action?>');$('#'+'validasi').submit();" class="btn btn-social btn-flat btn-info btn-sm pull-right"><i class="fa fa-print"></i> Cetak</button>
								<?php endif; ?>
								<?php if (SuratExport($url)): ?>
									<button type="button" onclick="submit_form_doc();" class="btn btn-social btn-flat btn-success btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-file-text"></i> Ekspor Dok</button>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class='modal fade' id='dialog' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<div class='modal-header'>
								<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
								<h4 class='modal-title' id='myModalLabel'><i class='fa fa-text-width text-yellow'></i> Perhatian</h4>
							</div>
							<div class='modal-body btn-info'>
								Salah satu calon pasangan, pria atau wanita, harus warga desa.
							</div>
							<div class='modal-footer'>
								<button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
