$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});
var grabedurl = window.location.pathname;
var url = "/api" + grabedurl;

var no = 0;
$.ajax({
    url: url,
    method: "GET",
    datatype: "json",
    success: function (berhasil) {
        $.each(berhasil.data, function (key, value) {
            no++;
            $("#produk_terbaru").append(
                `
                <div class="col-lg-4 col-md-6 item-entry mb-4">
                                <div class="f_p_item">
                                    <div class="f_p_img">
                                        <img class="img-fluid" src="/storage/produks/${value.gambar}" alt="${value.nama}">
                                            <form id="aa` +
                no +
                `">

                                                <input type="hidden" name="qty" id="sst" maxlength="1" value="1" class="input-text qty">
                                                <input type="hidden" name="produk_id" value="${value.id}" class="form-control">

                                            </form>
                                            <button type="submit" class="p_icon btn btn-lg btn-light" id="simpan` + no + `">
                                                <i class="icon-shopping-bag"></i>
                                            </button>
                                    </div>
                                    <a href="/produk/${value.slug} ">
                                        <h4>${value.nama}</h4>
                                    </a>
                                    <h5>Rp ${value.harga}</h5>
                                </div>
                            </div>
                `
            ).add(
                $("#simpan" + no + "").click(function (e) {
                    e.preventDefault();
                    // $(this).hide();
                    $.ajax({
                        data: $("#aa" + no + "").serialize(),
                        url: "/cart-add",
                        type: "POST",
                        dataType: "json",
                        success: function (data) {
                            $("#aa").trigger("reset");
                        },
                        error: function (request, status, error) {
                            //
                        }
                    })
                })
            );
        });
    }
});
