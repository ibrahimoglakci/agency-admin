function paketSil(i, n) {
    var e = i + "paket-sil/" + n;
    $(document).on("click", "#silmeAlani", function (i) {
        swal({ title: "Silmek istediğinden emin misin?", text: "Paketi silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.", icon: "warning", buttons: ["İptal Et", "Sil"], dangerMode: !0 }).then((i) => {
            i
                ? swal("Seçtiğin paket başarıyla silindi!", { icon: "success" }).then((i) => {
                      i && (window.location = e);
                  })
                : swal("Paketini hala güvende tutuyoruz.", { icon: "info" });
        });
    });
}
function play_sound_notify() {
    var i = document.createElement("audio");
    i.setAttribute("src", "assets/sounds/notify.mp3"), i.setAttribute("autoplay", "autoplay"), i.load(), i.play();
}
function siparisOnayla(i, n) {
    var e = i + "siparis-onayla/" + n;
    $(document).on("click", "#onaylaAlani", function (i) {
        swal({ title: "Onaylamak istediğinden emin misin?", text: "Siparişi onaylamak üzeresin! Eğer onaylamak istediğinden eminsen 'Onayla' butonuna tıkla.", icon: "warning", buttons: ["İptal Et", "Onayla"], dangerMode: !1 }).then((i) => {
            i
                ? swal("Harika! Sipariş başarıyla Onaylandı!", { icon: "success" }).then((i) => {
                      i && (window.location = e);
                  })
                : swal("Siparişi hala güvende tutuyoruz.", { icon: "info" });
        });
    });
}
function siparisTeslimEt(i, n) {
    var e = i + "siparis-teslim-et/" + n;
    $(document).on("click", "#teslimAlani", function (i) {
        swal({
            title: "Teslim istediğinden emin misin?",
            text: "Siparişi teslim etmek üzeresin! Eğer teslim etmek istediğinden eminsen 'Teslim Et' butonuna tıkla.",
            icon: "warning",
            buttons: ["İptal Et", "Teslim Et"],
            dangerMode: !0,
        }).then((i) => {
            i
                ? swal("Harika! Sipariş başarıyla teslim edildi!", { icon: "success" }).then((i) => {
                      i && (window.location = e);
                  })
                : swal("Siparişi hala güvende tutuyoruz.", { icon: "info" });
        });
    });
}
function siparisSil(i, n) {
    var e = i + "siparis-sil/" + n;
    $(document).on("click", "#silmeAlani", function (i) {
        swal({ title: "Silmek istediğinden emin misin?", text: "Siparişi silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.", icon: "warning", buttons: ["İptal Et", "Sil"], dangerMode: !0 }).then((i) => {
            i
                ? swal("Seçtiğin sipariş başarıyla silindi!", { icon: "success" }).then((i) => {
                      i && (window.location = e);
                  })
                : swal("Siparişini hala güvende tutuyoruz.", { icon: "info" });
        });
    });
}
function blogSil(i, n) {
    var e = i + "blog-sil/" + n;
    $(document).on("click", "#silmeAlani", function (i) {
        swal({ title: "Silmek istediğinden emin misin?", text: "Blogu silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.", icon: "warning", buttons: ["İptal Et", "Sil"], dangerMode: !0 }).then((i) => {
            i
                ? swal("Seçtiğin blog başarıyla silindi!", { icon: "success" }).then((i) => {
                      i && (window.location = e);
                  })
                : swal("Blogu hala güvende tutuyoruz.", { icon: "info" });
        });
    });
}
function kategoriSil(i, n) {
    var e = i + "kategori-sil/" + n;
    $(document).on("click", "#silmeAlani", function (i) {
        swal({ title: "Silmek istediğinden emin misin?", text: "Kategoriyi silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.", icon: "warning", buttons: ["İptal Et", "Sil"], dangerMode: !0 }).then((i) => {
            i
                ? swal("Seçtiğin kategori başarıyla silindi!", { icon: "success" }).then((i) => {
                      i && (window.location = e);
                  })
                : swal("Kategoriyi hala güvende tutuyoruz.", { icon: "info" });
        });
    });
}
function bannerSil(i, n) {
    var e = i + "banner-sil/" + n;
    $(document).on("click", "#silmeAlani", function (i) {
        swal({ title: "Silmek istediğinden emin misin?", text: "Banneri silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.", icon: "warning", buttons: ["İptal Et", "Sil"], dangerMode: !0 }).then((i) => {
            i
                ? swal("Seçtiğin banner başarıyla silindi!", { icon: "success" }).then((i) => {
                      i && (window.location = e);
                  })
                : swal("Banneri hala güvende tutuyoruz.", { icon: "info" });
        });
    });
}
function referansSil(i, n) {
    var e = i + "referans-sil/" + n;
    $(document).on("click", "#silmeAlani", function (i) {
        swal({ title: "Silmek istediğinden emin misin?", text: "Referansı silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.", icon: "warning", buttons: ["İptal Et", "Sil"], dangerMode: !0 }).then((i) => {
            i
                ? swal("Seçtiğin referans başarıyla silindi!", { icon: "success" }).then((i) => {
                      i && (window.location = e);
                  })
                : swal("Referansı hala güvende tutuyoruz.", { icon: "info" });
        });
    });
}
function randevuSil(i, n) {
    var e = i + "randevu-sil/" + n;
    $(document).on("click", "#silmeAlani", function (i) {
        swal({ title: "Silmek istediğinden emin misin?", text: "Randevuyu silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.", icon: "warning", buttons: ["İptal Et", "Sil"], dangerMode: !0 }).then((i) => {
            i
                ? swal("Seçtiğin randevu başarıyla silindi!", { icon: "success" }).then((i) => {
                      i && (window.location = e);
                  })
                : swal("Randevuyu hala güvende tutuyoruz.", { icon: "info" });
        });
    });
}
function gelirSil(i, n) {
    var e = i + "gelir-sil/" + n;
    $(document).on("click", "#silmeAlani", function (i) {
        swal({ title: "Silmek istediğinden emin misin?", text: "Geliri silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.", icon: "warning", buttons: ["İptal Et", "Sil"], dangerMode: !0 }).then((i) => {
            i
                ? swal("Seçtiğin gelir başarıyla silindi!", { icon: "success" }).then((i) => {
                      i && (window.location = e);
                  })
                : swal("Geliri hala güvende tutuyoruz.", { icon: "info" });
        });
    });
}
function giderSil(i, n, k) {
    var e = i + "gider-sil/" + k + "/" + n;
    $(document).on("click", "#silmeAlani", function (i) {
        swal({ title: "Silmek istediğinden emin misin?", text: "Gideri silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.", icon: "warning", buttons: ["İptal Et", "Sil"], dangerMode: !0 }).then((i) => {
            i
                ? swal("Seçtiğin gider başarıyla silindi!", { icon: "success" }).then((i) => {
                      i && (window.location = e);
                  })
                : swal("Gideri hala güvende tutuyoruz.", { icon: "info" });
        });
    });
}
$("#stok-tablo").DataTable({
    language: {
        lengthMenu: "Toplam _MENU_ sonuç göster",
        info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
        infoEmpty: "Hiç kayıt bulunamadı!",
        infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
        loadingRecords: "Yükleniyor...",
        processing: "İşleniyor...",
        zeroRecords: "Gösterilebilecek hiç bir kayıt bulunamadı!",
        searchPlaceholder: "Stoklarda Ara...",
        scrollX: "100%",
        sSearch: "",
        paginate: { next: "Sonraki", previous: "Önceki" },
        aria: { sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir", sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir" },
    },
}),
    $("#kargo-tablo").DataTable({
        language: {
            lengthMenu: "Toplam _MENU_ kargo göster",
            info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
            infoEmpty: "Hiç kargo kayıdı bulunamadı!",
            infoFiltered: "(filtre dışı toplam _MAX_ kargo kaydı)",
            loadingRecords: "Yükleniyor...",
            processing: "İşleniyor...",
            zeroRecords: "Gösterilebilecek hiç bir kargo kaydı bulunamadı!",
            searchPlaceholder: "Kargolarda Ara...",
            scrollX: "100%",
            sSearch: "",
            paginate: { next: "Sonraki", previous: "Önceki" },
            aria: { sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir", sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir" },
        },
    }),
    $("#paketcektablo").DataTable({
        responsive: !0,
        language: {
            zeroRecords: "Gösterilebilecek hiç bir kargo kaydı bulunamadı!",
            searchPlaceholder: "Kargolarda Ara...",
            scrollX: "100%",
            sSearch: "",
            paginate: { next: "Sonraki", previous: "Önceki" },
            aria: { sortAscending: ": sütunu artan şekilde sıralamak için etkinleştir", sortDescending: ": sütunu azalan şekilde sıralamak için etkinleştir" },
        },
    }),
    $(".select2").select2({ minimumResultsForSearch: 1 / 0 }),
    $("#yildizid").click(function () {
        var i = $("#icon-yildiz"),
            n = $(this).attr("postaID"),
            e = $(this).attr("site");
        $.ajax({
            url: e + "paketcek.php",
            type: "POST",
            data: { postaID: n, islemtipi: "postayildizla" },
            dataType: "json",
            success: function (n) {
                "yildizlandi" == n.durum && i.removeClass("fe fe-star").addClass("fa fa-star"), "cikarildi" == n.durum && i.removeClass("fa fa-star").addClass("fe fe-star");
            },
        });
    }),
    $("#yildizidlist").click(function () {
        var i = $("#icon-yildizlist"),
            n = $(this).attr("postaID"),
            e = $(this).attr("site");
        $.ajax({
            url: e + "paketcek.php",
            type: "POST",
            data: { postaID: n, islemtipi: "postayildizla" },
            dataType: "json",
            success: function (n) {
                "yildizlandi" == n.durum && i.addClass("inbox-started"), "cikarildi" == n.durum && i.removeClass("inbox-started");
            },
        });
    });
