$(function(e) {
	"use strict";
	$("#basic-datatable").DataTable({
		language: {
			searchPlaceholder: "Search...",
			sSearch: ""
		}
	});
	var a = $("#file-datatable").DataTable({
		buttons: ["copy", "excel", "pdf", "colvis"],
		language: {
			searchPlaceholder: "Ara...",
			scrollX: "100%",
			sSearch: ""
		}
	});
	a.buttons().container().appendTo("#file-datatable_wrapper .col-md-6:eq(0)");
	var a = $("#delete-datatable").DataTable({
		language: {
			searchPlaceholder: "Ara...",
			sSearch: ""
		}
	});
	$("#delete-datatable tbody").on("click", "tr", function() {
		$(this).hasClass("selected") ? $(this).removeClass("selected") : (a.$("tr.selected").removeClass("selected"), $(this).addClass("selected"))
	}), $("#button").on("click", function() {
		a.row(".selected").remove().draw(!1)
	}), $("#siparistable").DataTable({
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function(e) {
						return e.data()[2] + " için detaylar"
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: "table"
				})
			}
		},
		language: {
			lengthMenu: "Toplam _MENU_ sonuç göster",
			info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
			infoEmpty: "Hiç kayıt bulunamadı!",
			infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
			loadingRecords: "Yükleniyor...",
			processing: "İşleniyor...",
			zeroRecords: "Gösterilebilecek hiç bir kayıt bulunamadı!",
			searchPlaceholder: "Siparişlerde Ara...",
			scrollX: "100%",
			sSearch: "",
			paginate: {
				next: "Sonraki",
				previous: "Önceki"
			},
			aria: {
				sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir",
				sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir"
			}
		}
	});
	var a = $("#randevu-tablo").DataTable({
		order: [9, "asc"],
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function(e) {
						return e.data()[2] + " için detaylar"
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: "table"
				})
			}
		},
		language: {
			lengthMenu: "Toplam _MENU_ sonuç göster",
			info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
			infoEmpty: "Hiç kayıt bulunamadı!",
			infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
			loadingRecords: "Yükleniyor...",
			processing: "İşleniyor...",
			zeroRecords: "Gösterilebilecek hiç bir kayıt bulunamadı!",
			searchPlaceholder: "Randevularda Ara...",
			scrollX: "100%",
			sSearch: "",
			paginate: {
				next: "Sonraki",
				previous: "Önceki"
			},
			aria: {
				sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir",
				sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir"
			}
		},
		buttons: [{
			extend: "excelHtml5",
			title: "AVTR RANDEVU LİSTESİ"
		}, {
			extend: "pdfHtml5",
			title: "AVTR RANDEVU LİSTESİ"
		}]
	});
	a.buttons().container().appendTo("#randevu-tablo_wrapper .col-md-6:eq(0)");

	var u = $("#uye-tablo").DataTable({
		order: [1, "asc"],
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function(e) {
						return e.data()[2] + " için detaylar"
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: "table"
				})
			}
		},
		language: {
			lengthMenu: "Toplam _MENU_ sonuç göster",
			info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
			infoEmpty: "Hiç kayıt bulunamadı!",
			infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
			loadingRecords: "Yükleniyor...",
			processing: "İşleniyor...",
			zeroRecords: "Gösterilebilecek hiç bir kayıt bulunamadı!",
			searchPlaceholder: "Üyelerde Ara...",
			scrollX: "100%",
			sSearch: "",
			paginate: {
				next: "Sonraki",
				previous: "Önceki"
			},
			aria: {
				sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir",
				sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir"
			}
		},
		buttons: [{
			extend: "excelHtml5",
			title: "AVTR ÜYE LİSTESİ"
		}, {
			extend: "pdfHtml5",
			title: "AVTR ÜYE LİSTESİ"
		}]
	});
	u.buttons().container().appendTo("#uye-tablo_wrapper .col-md-6:eq(0)");

	var ge = $("#gelir-tablo").DataTable({
		order: [4, "desc"],
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function(e) {
						return e.data()[2] + " için detaylar"
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: "table"
				})
			}
		},
		language: {
			lengthMenu: "Toplam _MENU_ sonuç göster",
			info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
			infoEmpty: "Hiç kayıt bulunamadı!",
			infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
			loadingRecords: "Yükleniyor...",
			processing: "İşleniyor...",
			zeroRecords: "Gösterilebilecek hiç bir kayıt bulunamadı!",
			searchPlaceholder: "Gelirler İçerisinde Ara...",
			scrollX: "100%",
			sSearch: "",
			paginate: {
				next: "Sonraki",
				previous: "Önceki"
			},
			aria: {
				sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir",
				sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir"
			}
		},
		buttons: [{
			extend: "excelHtml5",
			title: "AVTR GELİR LİSTESİ"
		}, {
			extend: "pdfHtml5",
			title: "AVTR GELİR LİSTESİ"
		}]
	});
	ge.buttons().container().appendTo("#gelir-tablo_wrapper .col-md-6:eq(0)");

	var gi = $("#gider-tablo").DataTable({
		order: [4, "desc"],
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function(e) {
						return e.data()[1] + " için detaylar"
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: "table"
				})
			}
		},
		language: {
			lengthMenu: "Toplam _MENU_ sonuç göster",
			info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
			infoEmpty: "Hiç kayıt bulunamadı!",
			infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
			loadingRecords: "Yükleniyor...",
			processing: "İşleniyor...",
			zeroRecords: "Gösterilebilecek hiç bir kayıt bulunamadı!",
			searchPlaceholder: "Giderler İçerisinde Ara...",
			scrollX: "100%",
			sSearch: "",
			paginate: {
				next: "Sonraki",
				previous: "Önceki"
			},
			aria: {
				sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir",
				sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir"
			}
		},
		buttons: [{
			extend: "excelHtml5",
			title: "AVTR GİDER LİSTESİ"
		}, {
			extend: "pdfHtml5",
			title: "AVTR GİDER LİSTESİ"
		}]
	});
	gi.buttons().container().appendTo("#gider-tablo_wrapper .col-md-6:eq(0)");
	

	var fi = $("#fiyat-tablo").DataTable({
		order: [2, "asc"],
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function(e) {
						return e.data()[1] + " için detaylar"
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: "table"
				})
			}
		},
		language: {
			lengthMenu: "Toplam _MENU_ sonuç göster",
			info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
			infoEmpty: "Hiç kayıt bulunamadı!",
			infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
			loadingRecords: "Yükleniyor...",
			processing: "İşleniyor...",
			zeroRecords: "Gösterilebilecek hiç bir kayıt bulunamadı!",
			searchPlaceholder: "Fiyatlar İçerisinde Ara...",
			scrollX: "100%",
			sSearch: "",
			paginate: {
				next: "Sonraki",
				previous: "Önceki"
			},
			aria: {
				sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir",
				sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir"
			}
		},
		buttons: [{
			extend: "excelHtml5",
			title: "AVTR FİYAT LİSTESİ"
		}, {
			extend: "pdfHtml5",
			title: "AVTR FİYAT LİSTESİ"
		}]
	});
	fi.buttons().container().appendTo("#fiyat-tablo_wrapper .col-md-6:eq(0)");




    var p = $("#example3").DataTable({
		order: [7, "desc"],
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function(e) {
						return e.data()[2] + " için detaylar"
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: "table"
				})
			}
		},
		language: {
			lengthMenu: "Toplam _MENU_ sonuç göster",
			info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
			infoEmpty: "Hiç kayıt bulunamadı!",
			infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
			loadingRecords: "Yükleniyor...",
			processing: "İşleniyor...",
			zeroRecords: "Gösterilebilecek hiç bir kayıt bulunamadı!",
			searchPlaceholder: "Paketlerde Ara...",
			scrollX: "100%",
			sSearch: "",
			paginate: {
				next: "Sonraki",
				previous: "Önceki"
			},
			aria: {
				sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir",
				sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir"
			}
		},
		buttons: [{
			extend: "excelHtml5",
			title: "AVTR PAKET LİSTESİ"
		}, {
			extend: "pdfHtml5",
			title: "AVTR PAKET LİSTESİ"
		}]
	});
	p.buttons().container().appendTo("#example3_wrapper .col-md-6:eq(0)");

	$("#ref-tablo").DataTable({
		order: [4, "asc"],
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function(e) {
						return e.data()[2] + " için detaylar"
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: "table"
				})
			}
		},
		language: {
			lengthMenu: "Toplam _MENU_ sonuç göster",
			info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
			infoEmpty: "Hiç kayıt bulunamadı!",
			infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
			loadingRecords: "Yükleniyor...",
			processing: "İşleniyor...",
			zeroRecords: "Gösterilebilecek hiç bir kayıt bulunamadı!",
			searchPlaceholder: "Referanslarda Ara...",
			scrollX: "100%",
			sSearch: "",
			paginate: {
				next: "Sonraki",
				previous: "Önceki"
			},
			aria: {
				sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir",
				sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir"
			}
		},
		
	});

	
	

	var p = $("#example4").DataTable({
		order: [1, "asc"],
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function(e) {
						return e.data()[2] + " için detaylar"
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: "table"
				})
			}
		},
		language: {
			lengthMenu: "Toplam _MENU_ sonuç göster",
			info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
			infoEmpty: "Hiç kayıt bulunamadı!",
			infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
			loadingRecords: "Yükleniyor...",
			processing: "İşleniyor...",
			zeroRecords: "Gösterilebilecek hiç bir kayıt bulunamadı!",
			searchPlaceholder: "Kategorilerde Ara...",
			scrollX: "100%",
			sSearch: "",
			paginate: {
				next: "Sonraki",
				previous: "Önceki"
			},
			aria: {
				sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir",
				sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir"
			}
		},
		buttons: [{
			extend: "excelHtml5",
			title: "AVTR PAKET LİSTESİ"
		}, {
			extend: "pdfHtml5",
			title: "AVTR PAKET LİSTESİ"
		}]
	});
	p.buttons().container().appendTo("#example4_wrapper .col-md-6:eq(0)");




    
    $("#onaylanansiparisler").DataTable({
		order: [6, "asc"],
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function(e) {
						return e.data()[2] + " için detaylar"
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: "table"
				})
			}
		},
		language: {
			lengthMenu: "Toplam _MENU_ sonuç göster",
			info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
			infoEmpty: "Hiç kayıt bulunamadı!",
			infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
			loadingRecords: "Yükleniyor...",
			processing: "İşleniyor...",
			zeroRecords: "Gösterilebilecek hiç bir kayıt bulunamadı!",
			searchPlaceholder: "Siparişlerde Ara...",
			scrollX: "100%",
			sSearch: "",
			paginate: {
				next: "Sonraki",
				previous: "Önceki"
			},
			aria: {
				sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir",
				sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir"
			}
		},
		buttons: [{
			extend: "excelHtml5",
			title: "AVTR SİPARİŞ LİSTESİ"
		}, {
			extend: "pdfHtml5",
			title: "AVTR SİPARİŞ LİSTESİ"
		}]
	}).buttons().container().appendTo("#onaylanansiparisler_wrapper .col-md-6:eq(0)"), $("#example2").DataTable({
		responsive: !0,
		language: {
			searchPlaceholder: "Search...",
			sSearch: "",
			lengthMenu: "_MENU_ items/page"
		}
	}), $(".select2").select2({
		minimumResultsForSearch: 1 / 0
	})
});