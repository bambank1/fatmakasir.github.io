<?php 
	
	$sessid = session_id();
	$tema = info();
	$versi = time();
	// $versi = "3.0";
	$segment = $this->uri->segment(1);
	$cek_info = cek_info();
	$cekUser = cekUser($this->session->idu);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="<?= base_url('uploads/'); ?><?=info()['favicon'];?>" rel="icon">
        <title><?= $title; ?></title>
		
		
		<!--css vendor-->
		<?=link_tag('assets/vendor/fontawesome/css/font-awesome.css'); ?>
		<?=link_tag('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>
		<?=link_tag('assets/vendor/datatables/dataTables.bootstrap4.css'); ?>
		<?=link_tag('assets/vendor/selectize/css/selectize.css'); ?>
		<?=link_tag('assets/vendor/colorpick/colorPick.css'); ?>
		<?=link_tag('assets/vendor/sweetalert2/sweetalert2.min.css'); ?>
		<?=link_tag('assets/vendor/bootstrap-datepicker/bootstrap-datepicker.css'); ?>
		<?=link_tag('assets/vendor/icon-picker/simple-iconpicker.css'); ?>
		<?=link_tag('assets/vendor/jquery-ui-1.12.1/jquery-ui.css'); ?>
		<?=link_tag('assets/vendor/select2/dist/css/select2.min.css'); ?>
		<?=link_tag('assets/vendor/jquery-toast-plugin/dist/jquery.toast.min.css'); ?>
		<?=link_tag('assets/vendor/copy/primer.css'); ?>
		<?=link_tag('assets/vendor/mklb/mklb.css?v='.$versi); ?>
		<?=link_tag('assets/vendor/trumbowyg/dist/ui/trumbowyg.min.css'); ?>
		<?=link_tag('assets/vendor/notifications/noty.css'); ?>
		
		<!--css file-->
		<?=link_tag('assets/css/ruang-admin.css?v='.$versi); ?>
		<?=link_tag('assets/css/style-adm.css?v='.$versi); ?>
		<?=link_tag('assets/css/ns-default.css?v='.$versi); ?>
		<?=link_tag('assets/css/ns-style-other.css'); ?>
		<?=link_tag('assets/css/custom-style.css?r='.$versi); ?>
		<?=link_tag('assets/css/daterangepicker.css'); ?>
		<?=link_tag('assets/css/purecookie.css'); ?>
		<?=link_tag('assets/css/glightbox.min.css'); ?>
		<?=link_tag('assets/css/jquery.terminal.min.css'); ?>
		<?=link_tag('assets/css/component-chosen.css'); ?>
		<?=link_tag('assets/css/produk.css'); ?>
		<!--js file-->
		<script src="<?= base_url('assets/'); ?>js/jquery-3.6.0.slim.min.js"></script>
		
        <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
        <script src="<?= base_url('assets/'); ?>vendor/jquery-ui-1.12.1/jquery-ui.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?= base_url('assets/'); ?>js/moment.min.js"></script>
        <script src="<?= base_url('assets/'); ?>vendor/popper/src/popper.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>vendor/bootstrap-notify/bootstrap-notify.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>js/notif.js?v=<?=$versi;?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>vendor/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>vendor/jQuery-slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>js/shortcut.js" type="text/javascript"></script>
        
		<script src="<?= base_url('assets/'); ?>vendor/bootstrap-datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="<?= base_url('assets/'); ?>vendor/bootstrap-datepicker/bootstrap-datepicker.id.js" type="text/javascript"></script>
		<!-- Import Trumbowyg -->
		<script src="<?= base_url('assets/'); ?>vendor/trumbowyg/dist/trumbowyg.min.js" type="text/javascript"></script>
		<!-- Import Trumbowyg plugins... -->
		<script src="<?= base_url('assets/'); ?>vendor/trumbowyg/dist/plugins/upload/trumbowyg.upload.js" type="text/javascript"></script>
		<script src="<?= base_url('assets/'); ?>vendor/icon-picker/simple-iconpicker.js" type="text/javascript"></script>
		<script src="<?= base_url('assets/'); ?>js/js.cookie.min.js" type="text/javascript"></script>
		<script src="<?= base_url('assets/'); ?>js/antri_ajax.js" type="text/javascript"></script>
		<script src="<?= base_url('assets/'); ?>vendor/clipboard.js/dist/clipboard.min.js"></script>
		<script src="<?= base_url('assets/'); ?>vendor/notifications/noty.min.js"></script>
		<!-- Include Date Range Picker -->
		<script type="text/javascript" src="<?= base_url('assets/'); ?>js/daterangepicker.js"></script>
		<script src="<?= base_url('assets/'); ?>js/scroll.js" type="text/javascript"></script>
		<script src="<?= base_url('assets/'); ?>js/glightbox.min.js"></script>
		<script src="<?= base_url('assets/'); ?>vendor/jquery.loading/jquery.loading.js"></script>
		<script src="<?= base_url('assets/'); ?>js/loadingoverlay.js" type="text/javascript"></script>
		<script src="<?= base_url('assets/'); ?>js/loader.js" type="text/javascript"></script>
		<script src="<?= base_url('assets/'); ?>js/JsBarcode.all.min.js" type="text/javascript"></script>
		<script src="<?= base_url('assets/'); ?>node_modules/html5-qrcode/html5-qrcode.min.js" type="text/javascript"></script>
		
		
        <style>
			.ui-autocomplete {
			max-height: 400px;
			overflow-y: auto;   /* prevent horizontal scrollbar */
			overflow-x: hidden; /* add padding to account for vertical scrollbar */
			z-index: 9999 !important;
			}
			.trx-scroller {
			overflow-x: auto; }
			.trx-scroller .modal-body {
			flex-wrap: nowrap;
			white-space: nowrap; }
			.bg-navbar {
			background-color:<?=$tema['tema'];?>;
			}
			.sidebar-light .sidebar-brand {
			color: #fafafa;
			background-color:<?=$tema['tema'];?>;
			}
			.ba-we-love-subscribers .img {
			background-image: url("<?= base_url('assets/img/cart.png'); ?>");
			}
			.ba-we-love-subscribers-fab {
			width: 45px;
			height: 45px;
			background-color: <?=$tema['tema'];?>;
			border-radius: 30px;
			float: right;
			box-shadow: 0px 12px 45px rgba(0, 0, 0, .3);
			z-index: 5;
			position: relative;
			}
			
			.ba-we-love-subscribers-fab .img-fab {
			height: 25px;
			width: 25px;
			margin: 10px auto;
			background-image: url("<?=base_url('assets/img/cart.png'); ?>");
			
			}
			.ba-we-love-subscribers-wrap {
			position: fixed;
			right: 15px;
			bottom: 15px;
			z-index: 1000;
			}
			
			.input-group-append{
			z-index:1;
			}
		</style>
        <script>
			let level = '<?= $this->session->level; ?>',
			base_url = '<?=base_url(); ?>',
			dtime = '<?= $sessid; ?>',
			segment = '<?= $segment; ?>',
			my_ip = "<?=$_SERVER['SERVER_NAME']; ?>",
			computer_name = "<?=pengaturan('computer_name'); ?>",
			folder_af = "<?=pengaturan('folder_af'); ?>",
			folder_gm = "<?=pengaturan('folder_gm'); ?>",
			folder_ns = "<?=pengaturan('folder_ns'); ?>",
			folder_tz = "<?=pengaturan('folder_tz'); ?>",
			kasir = 1;
			var rklik = 1;
			
			shortcut.add("Home",function() {
				window.location.href = base_url;
			});
			
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
				$('[data-tooltip="tooltip"]').tooltip();
				$('#dari').attr('autocomplete','off');
				$('#sampai').attr('autocomplete','off');
				
			});
			
		</script>
		<?php
			cek_printer();
		?>
	</head>
	
	<body id="page-top" class="sidebar-toggled">
		<div id="wrapper">
			<?php
				$sq = $this->db->query("SELECT * from tb_users where id_user='".$this->session->idu."'");
				if($sq->num_rows()>0){
					$n =  $sq->row_array();
					$level = $n['level'];
					$parent = $n['parent'];
					$idm = $n['id_level'];
					$sidemenu = $n['idmenu'];
					
					if ($level=='admin' AND $parent==0){
						$sql= $this->db->query("select * from menuadmin where idparent='0' AND aktif='Y' order by urutan ASC");
						}else{
						$sql= $this->db->query("select * from menuadmin where idmenu IN ($sidemenu) AND idparent='0' AND aktif='Y' order by urutan ");
					}
					
					// echo $link_menu;
				?>
				<!-- Sidebar -->
				
				<ul class="navbar-nav sidebar sidebar-light accordion " id="accordionSidebar">
					<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('home'); ?>">
						<div class="sidebar-brand-icon">
							<img src="<?= base_url('uploads/'); ?><?=info()['favicon'];?>">
						</div>
						<div class="sidebar-brand-text mx-3">Panel Admin</div>
					</a>
					<hr class="sidebar-divider my-0">
					<div class="sidebars">
						<?php
							$link_menu = $this->uri->segment(1);
							foreach ($sql->result_array() as $m){
								$idlm = $m['id_level']; 
								$carimenu=$this->db->query("select * from menuadmin where link='$m[link]'");
								$sm = $carimenu->row_array();
								$menuid = explode(",",$idm);
								if (in_array($idm, $menuid)){
									$nama_menu = $sm['nama_menu'];
									$id_nama_menu = $m['nama_menu'];
								}
								
								if($m['treeview']=='header'){ ?>
								<hr class="sidebar-divider">
								<div class="sidebar-heading"><?=$m['nama_menu'];?></div>
								<?php }
								elseif($m['treeview']=='modal'){ ?>
								<li class="nav-item">
									<a class="nav-link openPopup" href="javascript:void(0);" data-href="<?=base_url().$m['link'];?>">
										<i class="fa fa-fw <?=$m['icon'];?> fa-lg"></i>
										<span><?=$m['nama_menu'];?></span>
									</a>
								</li>
								<?php }
								elseif($m['treeview']=='treeview'){
									$sub=$this->db->query("SELECT * FROM menuadmin WHERE idmenu IN ($sidemenu) AND idparent=$m[idmenu] AND aktif='Y' order by urutan");
									$subs=$this->db->query("SELECT * FROM menuadmin WHERE idparent='$m[idmenu]' AND aktif='Y' order by urutan")->row_array();
									
								$jml=$sub->num_rows(); ?>
								<li class="nav-item <?=$m['link'];?>">
									<a class="nav-link collapsed" href="<?=base_url().$m['link'];?>" data-toggle="collapse" data-target="#ex<?=$m['idmenu'];?>" aria-expanded="true" aria-controls="ex<?=$m['idmenu'];?>">
										<i class="fa fa-fw <?=$m['icon'];?> fa-lg"></i>
										<span><?=$m['nama_menu'];?></span>
									</a>
									<?php if (isset($subs)){
										if($subs['link']==$link_menu){ ?>
										<div id="ex<?=$m['idmenu'];?>" class="collapse show" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
											<?php }else{ ?>
											<div id="ex<?=$m['idmenu'];?>" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
												<?php }
											}else{ ?>
											<div id="ex<?=$m['idmenu'];?>" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
												<?php }
												if ($jml > 0){ ?>
												<div class="bg-white py-2 collapse-inner rounded">
													<h6 class="collapse-header"><?=$m['nama_menu'];?></h6>
													<?php 
														foreach ($sub->result_array() as $w){	?>
														<a class="collapse-item" href="<?=base_url().$w['link'];?>" target="<?=$w['target'];?>"><?=$w['nama_menu'];?></a>
													<?php } ?>
												</div>
											<?php } ?>
										</div>
									</li>
									<?php }else{ ?>
									<li class="nav-item">
										<a class="nav-link" href="<?=base_url().$m['link'];?>" target="<?=$m['target'];?>">
											<i class="fa fa-fw <?=$m['icon'];?> fa-lg"></i>
											<span><?=$m['nama_menu'];?></span>
										</a>
									</li>
									<?php }
									}
								?>
							</div>
							<hr class="sidebar-divider">
							<div class="version text-center pb-3" id="version-pospercetakan"></div>
						</ul>
					<?php } ?>
					<!-- Topbar -->
					<div id="content-wrapper" class="d-flex flex-column">
						<div id="content">
							<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
								<button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
									<i class="fa fa-bars"></i>
								</button>
								<ul class="navbar-nav ml-auto">
									<li class="nav-item no-arrow">
										<a class="nav-link" href="#">
											<i class="fa fa-clock-o fa-fw"></i> <div id="clock"></div>
										</a>
									</li>
									<li class="nav-item dropdown no-arrow">
										<a class="nav-link" href="#" data-toggle="modal" data-target="#myModalTab">
											<i class="fa fa-search fa-fw"></i>
										</a>
									</li>
									
									<li class="nav-item dropdown no-arrow mx-1 load-notif">
										
									</li>
									<div class="topbar-divider d-none d-sm-block"></div>
									<li class="nav-item dropdown no-arrow">
										<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img class="img-profile rounded-circle" src="<?= base_url('assets/'); ?>img/boy.png"
											style="max-width: 60px">
											<span
											class="ml-2 d-none d-lg-inline text-white small"><?=$cekUser['nama'];?></span>
										</a>
										<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
										aria-labelledby="userDropdown">
											<?php if ($this->session->level=='admin'){ ?>
												<a class="dropdown-item" href="<?=base_url();?>user/profil/<?=encrypt_url($this->session->idu);?>">
													<i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
													Profile
												</a>
												<a class="dropdown-item" href="<?=base_url();?>main/info">
													<i class="fa fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
													Settings
												</a>
												<?php }else{ ?>
												<a class="dropdown-item" href="<?=base_url();?>user/profil/<?=encrypt_url($this->session->idu);?>">
													<i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
													Profile
												</a>
											<?php } ?>
											
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="https://wa.me/62895326083254" target="_blank">
												<i class="fa fa-info fa-sm fa-fw mr-2 text-gray-400"></i>
												Hubungi Pengembang
											</a>
											<a class="dropdown-item" href="<?= base_url('main/'); ?>logout">
												<i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
												Logout
											</a>
										</div>
									</li>
								</ul>
							</nav>
							
							<!-- Topbar -->
							<?php
								echo $contents;
								$this->load->view('produk/modal_popup');
								
							?>
							<div id="load-modal"></div>
						</div>
						<?php if($segment!='penjualan'){ ?>
							<div class="ba-we-love-subscribers-wrap">
								
								<div class="ba-we-love-subscribers-fab">
									<div class="wrap">
										<a href="#" class="button_transaksi" data-id="0" data-modedit="baru" id="cart"><div class="img-fab img"></div></a>
									</div>
								</div>
							</div>
						<?php } ?>
						<!-- Footer -->
						<footer class="sticky-footer bg-white">
							<div class="container my-auto">
								<div class="copyright text-center my-auto">
									<span><?= copyYear(2020) .' | '.SITE_NAME.' | '.$cek_info['browser'].' | '.$cek_info['os'].' | IP: '.$cek_info['ip']; ?> | Themes by <a href="https://indrijunanda.github.io/RuangAdmin/" target="_blank">Ruang Admin</a></span>
								</div>
							</div>
						</footer>
						<!-- Footer -->
					</div>
				</div>
				<?php
					$pesan = $this->session->flashdata('dataNull');
					if(!empty($pesan)):
				?>
				<script>
					$(window).on('load',function(){
						let pesan = "<?= $pesan ?>";
						Swal.fire('Oops!',pesan,'error');
					});
				</script>
				<?php endif; ?>  
				<!-- Scroll to top -->
				<a class="scroll-to-top rounded" href="#page-top">
					<i class="fa fa-angle-up"></i>
				</a>
				<script src="<?=base_url('assets/');?>vendor/jquery-toast-plugin/dist/jquery.toast.min.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>vendor/datatables/jquery.dataTables.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>vendor/datatables/dataTables.bootstrap4.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>vendor/datatables/buttons.bootstrap4.min.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>js/ruang-admin.min.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>js/validation.min.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>vendor/selectize/js/standalone/selectize.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>vendor/select2/dist/js/select2.min.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>js/jquery.fileDownload.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>js/jquery.fcs.js?v=<?=$versi;?>" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>vendor/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>vendor/chart.js/Chart.min.js" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>js/chart/chart-penjualan.js?v=<?=$versi;?>" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>js/domath.js?v=<?=$versi;?>" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>js/popup.js?v=<?=$versi;?>" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>js/app.js?v=<?=$versi;?>" type="text/javascript"></script>
				<script src="<?=base_url('assets/');?>js/tab.js?v=<?=$versi;?>" type="text/javascript"></script>
				<script src="<?= base_url('assets/'); ?>js/custom.js?v=<?=$versi;?>" type="text/javascript"></script>
				<script src="<?= base_url('assets/'); ?>js/pencarian.js?v=<?=$versi;?>" type="text/javascript"></script>
				<script src="<?= base_url('assets/'); ?>js/url_doc.js?v=<?=$versi;?>" type="text/javascript"></script>
				<script src="<?= base_url('assets/'); ?>js/clock.js?v=<?=$versi;?>" type="text/javascript"></script>
				<script src="<?= base_url('assets/'); ?>vendor/copy/clipboard.js"></script>
				<script src="<?= base_url('assets/'); ?>vendor/mklb/mklb.js"></script>
				<script src="<?= base_url('assets/'); ?>js/version.js?v=<?=$versi;?>"></script>
				
				<script>
					if(rklik==1){
						document.addEventListener('contextmenu', (e) => e.preventDefault());
						
						function ctrlShiftKey(e, keyCode) {
							return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
						}
						
						document.onkeydown = (e) => {
							
							if (
							event.keyCode === 123 ||
							ctrlShiftKey(e, 'I') ||
							ctrlShiftKey(e, 'J') ||
							ctrlShiftKey(e, 'C') ||
							(e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
							)
							return false;
						};
					}
					
				</script>
				<?php 
					if($_SERVER['HTTP_HOST']!='localhost' OR $_SERVER['HTTP_HOST'] == $this->input->ip_address()){ ?>
					<script type="module">
						 
							import devtools from  '/assets/vendor/devtools-detect/index.js';
							if(devtools.isOpen){
								window.location.href = base_url+ "404";
							}
							window.addEventListener('devtoolschange', event => {
								if(event.detail.isOpen){
									window.location.href = base_url+ "404";
								}
							});
					 
					</script>
				<?php } ?>
			</body>
		</html>																																																														