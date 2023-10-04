$(document).ready(function() {

    // Basic example
    var example1 = new BSTable("basic-edit");
    example1.init();

    // New row edit-table example
    var example2 = new BSTable("new-edit", {
        $addButton: $('#table2-new-row-button'),
        onEdit:function() {
            console.log("EDITED");
        },
    });
    example2.init();

    // Example only some columns editable & removed actions column label
    var example3 = new BSTable("removecolumns-edit", {
        editableColumns:"4",
        advanced: {
            columnLabel: ''
        }
    });
    example3.init();

    $('#removecolumns-edit').DataTable({
        language: {
            lengthMenu: "Toplam _MENU_ sonuç göster",
            info: "Gösterilen _PAGE_. sayfa (Toplam _PAGES_ sayfa)",
            infoEmpty: "Hiç kayıt bulunamadı!",
            infoFiltered: "(filtre dışı toplam _MAX_ kayıt)",
            loadingRecords: "Yükleniyor...",
            processing:     "İşleniyor...",
            zeroRecords:    "Gösterilebilecek hiç bir kayıt bulunamadı!",
            searchPlaceholder: 'Ara...',
            scrollX: "100%",
            sSearch: '',
            paginate: {
                "next":       "Sonraki",
                "previous":   "Önceki"
            },
            aria: {
                "sortAscending":  ": sütunu artan şekilde sıralamak için etkinleştir",
                "sortDescending": ": sütunu azalan şekilde sıralamak için etkinleştir"
            }
        }
    });

} );

