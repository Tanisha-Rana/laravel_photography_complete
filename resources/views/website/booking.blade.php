@extends('website.layout.structure')

@section('content')
<body class="bg-light">

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow p-4 border-0 rounded-4">

                <!-- Branding -->
                <div class="text-center mb-4">
                    <img src="{{ asset('website/img/logo.png') }}" alt="Photography By Monali" style="width:90px; border-radius:12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <h5 class="mt-3 font-dancing-script text-primary" style="font-size: 28px;">Photography By Monali</h5>
                    <p class="text-muted small">Capture Your Precious Moments</p>
                </div>

                @php 
                    $pre_cat = request()->get('category_id');
                    $pre_theme = request()->get('catalogue_id');
                    $pre_pack = request()->get('package_id');
                    
                    // Identify Category IDs for filtering add-ons
                    $maternity_id = 0;
                    $newborn_id = 0;
                    $family_id = 0;
                    $kids_id = 0;
                    if(isset($cate_arr)){
                        foreach($cate_arr as $c) {
                            if(stripos($c->category_name, 'Maternity') !== false) $maternity_id = $c->category_id;
                            if(stripos($c->category_name, 'New Born') !== false) $newborn_id = $c->category_id;
                            if(stripos($c->category_name, 'family') !== false) $family_id = $c->category_id;
                            if(stripos($c->category_name, 'Kids') !== false) $kids_id = $c->category_id;
                        }
                    }
                @endphp
                
                <form method="post" id="bookingForm" onsubmit="return validateForm()">
                    @csrf
                    <!-- 1. Category -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">1. Select Shoot Category</label>
                        <select name="category_id" id="category_id" class="form-select form-select-lg shadow-sm border-0 bg-light" required style="font-size: 16px;">
                            <option value="">-- Choose Category --</option>
                            @isset($cate_arr)
                                @foreach($cate_arr as $cat)
                                    <option value="{{ $cat->category_id }}" {{ ($pre_cat == $cat->category_id) ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <!-- 2. Package -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">2. Choose Package</label>
                        <select name="package_id" id="package_id" class="form-select form-select-lg shadow-sm border-0 bg-light" required style="font-size: 16px;">
                            <option value="">-- Choose Package --</option>
                        </select>
                    </div>

                    <!-- 3. Themes (Visual Selection) -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                             <label class="form-label fw-bold mb-0">3. Select Theme / Setup</label>
                             <span id="limit-msg" class="badge bg-primary rounded-pill"></span>
                        </div>

                        <div id="theme-preview" class="mb-3 p-3 rounded-4 bg-white shadow-sm" style="display:none;">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div>
                                    <h6 class="mb-1 fw-bold">Selected Theme Preview</h6>
                                    <p class="small text-muted mb-0">This will show the image of the theme you choose.</p>
                                </div>
                            </div>
                            <div class="ratio ratio-16x9 rounded overflow-hidden">
                                <img id="themePreviewImage" src="{{ asset('upload/catalogues/Little Ms. Poser.jpeg') }}" alt="Theme preview" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <div id="themePreviewName" class="text-center mt-2 small text-muted"></div>
                        </div>
                        
                        <div id="theme-grid" class="row g-2" style="max-height: 400px; overflow-y: auto; padding: 10px; border-radius: 10px; background: #f8f9fa; display:none;">
                            <!-- Themes loaded via AJAX -->
                        </div>
                        <div id="no-themes-msg" class="text-center py-3 text-muted" style="display:none;">
                            Please select a category first to see available themes.
                        </div>
                    </div>

                    <!-- 4. Date -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">4. Preferred Date</label>
                        <input type="date" name="appointment_date" class="form-control form-control-lg shadow-sm border-0 bg-light" required min="{{ date('Y-m-d', strtotime('+7 days')) }}">
                    </div>

                    <!-- 5. Time Slot -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">5. Choose Time Slot</label>
                        <select name="slot_id" id="slot_id" class="form-select form-select-lg shadow-sm border-0 bg-light" required style="font-size: 16px;">
                            <option value="">-- Choose Slot --</option>
                            @isset($slot_arr)
                                @foreach($slot_arr as $slot)
                                    <option value="{{ $slot->slot_id }}">{{ $slot->slot_name }} ({{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }})</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <!-- 6. Shoot Location -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">6. Where will we shoot?</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <select name="venue_type" id="venue_type" class="form-select form-select-lg shadow-sm border-0 bg-light" required onchange="toggleVenueAddress()">
                                    <option value="studio">Our Studio (Included)</option>
                                    <option value="home">Home Visit (+ ₹3,500)</option>
                                    <option value="outdoor">Outdoor Location (+ ₹3,500)</option>
                                </select>
                            </div>
                            <div class="col-md-12" id="venue_address_container" style="display:none;">
                                <label class="form-label small fw-bold text-muted">VENUE ADDRESS / LOCATION DETAILS</label>
                                <textarea name="venue_address" id="venue_address" class="form-control shadow-sm border-0 bg-light" rows="2" placeholder="Street, Area, Landmark..."></textarea>
                                <div class="mt-2 small text-primary p-2 bg-primary-subtle rounded-3">
                                    <i class="bi bi-info-circle me-1"></i> For home visits, we bring a portable studio setup including backgrounds, lights, and props.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Discount / Coupon -->
                    
                    <!-- 8. Terms and Conditions -->
                    <div class="mb-4 bg-light p-3 rounded-3 border">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms_agree" required>
                            <label class="form-check-label small text-muted" for="terms_agree">
                                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal" class="text-primary fw-bold text-decoration-none">Terms and Conditions</a> of Photography By Monali.
                            </label>
                        </div>
                    </div>

                    <button type="submit" name="book" class="btn btn-primary w-100 py-3 fw-bold shadow-sm rounded-pill mb-3">
                        <i class="bi bi-calendar-heart me-2"></i> Request Appointment
                    </button>
                    
                    <div class="text-center">
                        <a href="{{ url('mybooking') }}" class="text-muted small text-decoration-none">View My Recent Requests</a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<style>
.theme-card {
    cursor: pointer;
    border: 2px solid transparent;
    border-radius: 10px;
    background: #fff;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}
.theme-card:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.1); }
.theme-card.selected { border-color: #d81b60; background: #fffafb; }
.selection-check {
    position: absolute;
    top: 5px;
    right: 5px;
    color: #d81b60;
    font-size: 20px;
    display: none;
    background: white;
    border-radius: 50%;
    line-height: 1;
}
.theme-card.selected .selection-check { display: block; }
#theme-grid::-webkit-scrollbar { width: 6px; }
#theme-grid::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
</style>

<script>
var maxThemes = 1;
var preTheme = "{{ $pre_theme }}";
var prePack = "{{ $pre_pack }}";

function filterOptions() {
    var catId = document.getElementById('category_id').value;
    
    if(!catId) {
        document.getElementById('package_id').innerHTML = '<option value="">-- Choose Package --</option>';
        document.getElementById('theme-grid').innerHTML = '';
        document.getElementById('theme-grid').style.display = 'none';
        document.getElementById('no-themes-msg').style.display = 'block';
        
        updateLimit();
        return;
    }

    // 1 & 2. Fetch Packages and Themes
    fetch('{{ url("get-category-data") }}?category_id=' + catId)
    .then(res => res.json())
    .then(data => {
        // Populate Packages
        let pkgHtml = '<option value="">-- Choose Package --</option>';
        data.packages.forEach(pkg => {
            let selected = (pkg.package_id == prePack) ? 'selected' : '';
            pkgHtml += `<option value="${pkg.package_id}" data-max="${pkg.max_catelogues}" ${selected}>${pkg.package_name} – ₹${pkg.price} (Max ${pkg.max_catelogues} Themes)</option>`;
        });
        document.getElementById('package_id').innerHTML = pkgHtml;
        
        // Populate Themes
        let themeHtml = '';
        if(data.themes.length > 0) {
            let previewTheme = null;
            data.themes.forEach(theme => {
                let isSelected = (theme.catalogue_id == preTheme) ? 'selected' : '';
                let isChecked = (theme.catalogue_id == preTheme) ? 'checked' : '';
                
                let imgUrl = `{{ asset('upload/catalogues') }}/${theme.image}`;
                if (theme.catalogue_id == preTheme) {
                    previewTheme = { name: theme.catalogue_name, img: imgUrl };
                }
                themeHtml += `
                <div class="col-6 col-sm-4 theme-card-wrapper" data-cat="${theme.category_id}">
                    <div class="theme-card position-relative ${isSelected}" data-theme-name="${theme.catalogue_name}" data-theme-img="${imgUrl}" onclick="toggleTheme(this, ${theme.catalogue_id})">
                        <img src="${imgUrl}" class="img-fluid rounded" style="height: 120px; width: 100%; object-fit: cover;">
                        <div class="theme-name p-2 small text-center fw-bold">${theme.catalogue_name}</div>
                        <div class="selection-check">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <input type="checkbox" name="catalogue_id[]" value="${theme.catalogue_id}"
                               id="theme_${theme.catalogue_id}" class="d-none" ${isChecked}>
                    </div>
                </div>`;
            });
            document.getElementById('theme-grid').innerHTML = themeHtml;
            document.getElementById('theme-grid').style.display = 'flex';
            document.getElementById('no-themes-msg').style.display = 'none';
            if (previewTheme) {
                updateThemePreview(previewTheme.name, previewTheme.img);
            }
        } else {
            document.getElementById('theme-grid').innerHTML = '';
            document.getElementById('theme-grid').style.display = 'none';
            document.getElementById('no-themes-msg').innerHTML = 'No themes available for this category.';
            document.getElementById('no-themes-msg').style.display = 'block';
        }

        updateLimit();
        
        // Reset pre values so manual changes work normally
        preTheme = "";
        prePack = "";
    }).catch(err => console.error(err));
}

function updateLimit() {
    var pkgSelect = document.getElementById('package_id');
    var selectedPkg = pkgSelect.selectedOptions[0];
    
    if(selectedPkg && selectedPkg.value != "") {
        maxThemes = parseInt(selectedPkg.getAttribute('data-max')) || 1;
        document.getElementById('limit-msg').innerHTML = "Max " + maxThemes + " Themes";
    } else {
        maxThemes = 1;
        document.getElementById('limit-msg').innerHTML = "";
    }
}

function toggleTheme(card, id) {
    var checkbox = document.getElementById('theme_' + id);
    var selectedCount = document.querySelectorAll('.theme-card.selected').length;
    var name = card.dataset.themeName || '';
    var imgUrl = card.dataset.themeImg || '{{ asset("website/img/image1.png") }}';

    if (!card.classList.contains('selected')) {
        if (selectedCount >= maxThemes) {
            Swal.fire({
                title: 'Limit Reached',
                text: "Your selected package only allows a maximum of " + maxThemes + " themes.",
                icon: 'warning',
                confirmButtonColor: '#E7B894'
            });
            return;
        }
        card.classList.add('selected');
        checkbox.checked = true;
        updateThemePreview(name, imgUrl);
    } else {
        card.classList.remove('selected');
        checkbox.checked = false;
        var remaining = document.querySelector('.theme-card.selected');
        if (remaining) {
            updateThemePreview(remaining.dataset.themeName, remaining.dataset.themeImg);
        } else {
            hideThemePreview();
        }
    }
}

function updateThemePreview(name, imgUrl) {
    document.getElementById('themePreviewImage').src = imgUrl;
    document.getElementById('themePreviewName').innerHTML = name;
    document.getElementById('theme-preview').style.display = 'block';
}

function hideThemePreview() {
    document.getElementById('theme-preview').style.display = 'none';
    document.getElementById('themePreviewName').innerHTML = '';
}

document.getElementById('category_id').addEventListener('change', filterOptions);
document.getElementById('package_id').addEventListener('change', updateLimit);

function validateForm() {
    var selectedCount = document.querySelectorAll('.theme-card.selected').length;
    if(selectedCount == 0) {
        Swal.fire({
            title: 'Selection Required',
            text: "Please select at least one theme.",
            icon: 'info',
            confirmButtonColor: '#E7B894'
        });
        return false;
    }

    var slot = document.getElementById('slot_id');
    if(slot.value == "") {
        Swal.fire({
            title: 'Time Slot',
            text: "Please select a time slot.",
            icon: 'info',
            confirmButtonColor: '#E7B894'
        });
        return false;
    }

    var terms = document.getElementById('terms_agree');
    if(!terms.checked) {
        Swal.fire({
            title: 'Terms of Service',
            text: "Please agree to the Terms and Conditions to proceed.",
            icon: 'warning',
            confirmButtonColor: '#E7B894'
        });
        return false;
    }
    return true;
}

function applyCoupon() {
    var code = document.getElementById('coupon_code').value;
    if(code == "") return;
    
    fetch('{{ url("check_coupon") }}?code=' + code)
        .then(response => response.json())
        .then(data => {
            var msg = document.getElementById('coupon-msg');
            if(data.status == 'success') {
                msg.innerHTML = "Coupon Applied! " + (data.data.discount_type == 'percentage' ? data.data.discount_value + '%' : '₹' + data.data.discount_value) + " Discount";
                msg.className = "small mt-1 text-success fw-bold";
                document.getElementById('applied_coupon_id').value = data.data.coupon_id;
            } else {
                msg.innerHTML = data.message;
                msg.className = "small mt-1 text-danger fw-bold";
                document.getElementById('applied_coupon_id').value = "";
            }
        });
}

function toggleVenueAddress() {
    var type = document.getElementById('venue_type').value;
    var container = document.getElementById('venue_address_container');
    container.style.display = (type == 'home' || type == 'outdoor') ? 'block' : 'none';
}

window.onload = function() {
    filterOptions();
    updateLimit();
    toggleVenueAddress();
};
</script>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header bg-primary text-white rounded-top-4 py-3">
                <h5 class="modal-title fw-bold" id="termsModalLabel"><i class="bi bi-shield-check me-2"></i> Booking Policy & Terms</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="max-height: 480px; overflow-y: auto;">
                <div class="mb-4">
                    <h6 class="fw-bold text-primary border-bottom pb-2 d-flex align-items-center">
                        <i class="bi bi-calendar-check me-2"></i> 1. Booking Procedure & Terms
                    </h6>
                    <ul class="list-unstyled small text-muted mt-2 ps-3">
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> Booking requires an <b>advance payment of 20%</b> of total package amount to secure your slot.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> Deposit is non-refundable but can be reused for a future session.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>No rescheduling</b> allowed for weekend shoots once confirmed.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> Storage responsibility for your photos ends <b>3 months</b> post-shoot.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> Ideal timing for pregnancy sessions: <b>28–32 weeks</b> for best results.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> Any rescheduling needs at least <b>48-hour prior notice</b>.</li>
                    </ul>
                </div>
                <div class="mb-0">
                    <h6 class="fw-bold text-primary border-bottom pb-2 d-flex align-items-center">
                        <i class="bi bi-box-seam me-2"></i> 2. Deliverables & Terms
                    </h6>
                    <ul class="list-unstyled small text-muted mt-2 ps-3">
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Timeline:</b> Raw photos within 3 days; Edited photos within a week.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Albums:</b> Photobook & album delivery takes 30–35 days post-selection.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Delivery:</b> All high-resolution photos will be shared via Google Drive link.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Logo:</b> Edited photos include studio logo unless explicitly opted out.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Privacy:</b> Private sessions (no social media posting) incur a <b>25% extra charge</b>.</li>
                        <li class="mb-2"><i class="bi bi-dot me-1"></i> <b>Time:</b> Late arrival may shorten your session duration to respect further appointments.</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light rounded-bottom-4">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
