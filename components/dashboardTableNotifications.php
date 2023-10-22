<div class="products-area-wrapper tableView" id='notification' style='display:none'>


    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="box shadow-sm rounded bg-white mb-3">
                    <div class="box-title border-bottom p-3">
                        <h6 class="m-0">Recent</h6>
                    </div>
                    <div class="box-body p-0 recent">
                    </div>
                </div>
                <div class="box shadow-sm rounded bg-white mb-3">
                    <div class="box-title border-bottom p-3">
                        <h6 class="m-0">Earlier</h6>
                    </div>
                    <div class="box-body p-0 earlier">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media screen and (max-width: 768px) {
            .btn.btn-light.btn-sm.rounded{
            display: none;
            }
            .btn-group{
                width: 150%;
            }
            .text-right.text-muted.pt-1{
                font-size: 0.7em;
            }
            .products-area-wrapper{
                width: 109%;
                overflow: hidden;
            }
            
        }
      
    </style>

<script src='scripts/notifications/getNotifications.js'></script>

<script>
    // ARGOTERA DES TO EINAI GIA TA DELETE BUTTOn
// document.addEventListener("DOMContentLoaded", function() {
//     actions=document.querySelectorAll('.mdi.mdi-dots-vertical')
//         actions.forEach(function(action,index){
//             action.addEventListener('click',function(){
//             dropmenu=document.querySelector(`.notification-box:nth-child(${index}) .dropdown-menu`)
//             dropmenu.style.display= dropmenu.style.display=='block' ? 'none':'block';
//         })
//     })
// })

</script>