$(".modal-effect").on("click",function(t){t.preventDefault();var a=$(this).attr("data-effect");$("#modaldemo8").addClass(a)}),$("#modaldemo8").on("hidden.bs.modal",function(t){$(this).removeClass(function(t,a){return(a.match(/(^|\s)effect-\S+/g)||[]).join(" ")})}),$(".paketkodonay").click(function(){var t=$(".paketlertable"),a="SRK-"+$('input[name="paketkod"]').val();$(".modal-title").text(a+" kodlu paket"),$.ajax({url:"https://admin.srkajans.com/paketcek.php",type:"POST",data:{paketkodu:a,islemtipi:"paketcek"},dataType:"json",success:function(a){gorbutton='<a href="https://srkajans.com/paketler/'+a.paketkod+'" target="_blank" style="margin-right: 3px;" class="btn btn-warning btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Paketi G\xf6r" data-bs-content="Paketi g\xf6rmek i\xe7in tıkla!"><i class="fa fa-eye" style="color: #383e42;"></i> </a>',1==a.ifiyat&&(idurum="Aktif",icolor="lime"),2==a.ifiyat&&(idurum="Pasif",icolor="red"),datas="<td>"+a.paketkod+"</td> <td>"+a.paketismi+"</td> <td>"+a.kategori+"</td> <td>"+a.fiyat+"₺</td> <td>"+gorbutton+"</td>",a.durum="ok",t.html(datas)}})});