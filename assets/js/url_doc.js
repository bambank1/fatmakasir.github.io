iLink = {
  transaksi : base_url + "dokumentasi/page#section-1",
  pengguna : base_url + "dokumentasi/page#item-2-1",
  jenis_bayar : base_url + "dokumentasi/page#item-2-2",
  rekening : base_url + "dokumentasi/page#item-2-3",
  aplikasi : base_url + "dokumentasi/page#item-2-4",
  printer : base_url + "dokumentasi/page#item-2-5",
  menu_admin : base_url + "dokumentasi/page#item-2-6",
  folder : base_url + "dokumentasi/page#item-2-7",
  jenis : base_url + "dokumentasi/page#item-3-1",
  bahan : base_url + "dokumentasi/page#item-3-2",
  satuan : base_url + "dokumentasi/page#item-3-3",
  produk : base_url + "dokumentasi/page#item-3-4",
  supplier : base_url + "dokumentasi/page#item-3-5",
  jenis_pengeluaran : base_url + "dokumentasi/page#item-3-6",
  kas : base_url + "dokumentasi/page#item-4-1",
  mutasi : base_url + "dokumentasi/page#item-4-2",
  penjualan : base_url + "dokumentasi/page#item-5-1",
  lap_rincian : base_url + "dokumentasi/page#item-5-2",
  uang_masuk : base_url + "dokumentasi/page#item-5-3",
  pendapatan : base_url + "dokumentasi/page#item-5-4",
  piutang : base_url + "dokumentasi/page#item-5-5",
  pengeluaran : base_url + "dokumentasi/page#item-5-6",
  log : base_url + "dokumentasi/page#item-5-7",
  pelanggan : base_url + "dokumentasi/page#section-10",
  grafik_omset : base_url + "dokumentasi/page#item-6-1",
  grafik_produk : base_url + "dokumentasi/page#item-6-2",
};

$(document).on("click", ".url_doc", function() {
  const indexLookupKey = $(this).attr("data-url");
  const xlsurl = iLink[indexLookupKey];
  window.open(xlsurl, "_blank");
  $(this).tooltip("hide");
});
