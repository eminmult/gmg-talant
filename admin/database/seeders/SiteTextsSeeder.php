<?php

namespace Database\Seeders;

use App\Models\SiteText;
use Illuminate\Database\Seeder;

class SiteTextsSeeder extends Seeder
{
    public function run(): void
    {
        $texts = [
            // ===== HERO =====
            ['key' => 'hero_badge', 'value' => 'GMG Talent Show 2026', 'section' => 'hero', 'label' => 'Badge mətni'],
            ['key' => 'hero_title', 'value' => 'İstedadını<br><span class="accent">Göstər!</span>', 'section' => 'hero', 'label' => 'Əsas başlıq'],
            ['key' => 'hero_subtitle', 'value' => 'Komandamızda gizli qalan istedadları üzə çıxarmaq və bir-birimizi fərqli tərəfdən tanımaq üçün şirkətdaxili istedad müsabiqəsinə start veririk!', 'section' => 'hero', 'label' => 'Alt başlıq'],
            ['key' => 'hero_cta', 'value' => 'İştirak et', 'section' => 'hero', 'label' => 'CTA düyməsi'],
            ['key' => 'hero_scroll', 'value' => 'Aşağı', 'section' => 'hero', 'label' => 'Scroll mətni'],

            // ===== NAV =====
            ['key' => 'nav_talents', 'value' => 'Talantlar', 'section' => 'nav', 'label' => 'Naviqasiya: Talantlar linki'],
            ['key' => 'nav_rules', 'value' => 'Qaydalar', 'section' => 'nav', 'label' => 'Naviqasiya: Qaydalar linki'],
            ['key' => 'nav_apply', 'value' => 'İştirak et', 'section' => 'nav', 'label' => 'Naviqasiya: İştirak linki'],
            ['key' => 'nav_jury_btn', 'value' => 'Münsiflər Heyəti', 'section' => 'nav', 'label' => 'Naviqasiya: Jury düyməsi'],

            // ===== TIMELINE =====
            ['key' => 'timeline_1_title', 'value' => 'Qeydiyyat', 'section' => 'timeline', 'label' => 'Faza 1: başlıq'],
            ['key' => 'timeline_1_date', 'value' => '20 fevral, 2026', 'section' => 'timeline', 'label' => 'Faza 1: tarix'],
            ['key' => 'timeline_1_desc', 'value' => 'Ərizələrin qəbulu və videoların yüklənməsi', 'section' => 'timeline', 'label' => 'Faza 1: təsvir'],
            ['key' => 'timeline_2_title', 'value' => 'Səsvermə', 'section' => 'timeline', 'label' => 'Faza 2: başlıq'],
            ['key' => 'timeline_2_date', 'value' => 'Tezliklə', 'section' => 'timeline', 'label' => 'Faza 2: tarix'],
            ['key' => 'timeline_2_desc', 'value' => 'Şirkətdaxili səsvermə və Münsiflər Heyətinin qiymətləndirməsi', 'section' => 'timeline', 'label' => 'Faza 2: təsvir'],
            ['key' => 'timeline_3_title', 'value' => 'Final', 'section' => 'timeline', 'label' => 'Faza 3: başlıq'],
            ['key' => 'timeline_3_date', 'value' => 'Tezliklə', 'section' => 'timeline', 'label' => 'Faza 3: tarix'],
            ['key' => 'timeline_3_desc', 'value' => 'Münsiflər Heyətinin final səsverməsi, finalistlərin seçilməsi', 'section' => 'timeline', 'label' => 'Faza 3: təsvir'],
            ['key' => 'timeline_4_title', 'value' => 'Mükafatlandırma', 'section' => 'timeline', 'label' => 'Faza 4: başlıq'],
            ['key' => 'timeline_4_date', 'value' => 'Tezliklə', 'section' => 'timeline', 'label' => 'Faza 4: tarix'],
            ['key' => 'timeline_4_desc', 'value' => 'Qalibin elan olunması. Mükafat fondu: 500 AZN', 'section' => 'timeline', 'label' => 'Faza 4: təsvir'],

            // ===== VIDEOS =====
            ['key' => 'videos_tag', 'value' => 'İştirakçıların videoları', 'section' => 'videos', 'label' => 'Tag mətni'],
            ['key' => 'videos_title', 'value' => 'İstedadları kəşf et', 'section' => 'videos', 'label' => 'Başlıq'],
            ['key' => 'videos_subtitle', 'value' => 'Həmkarlarımızın istedadlarına bax, ilhamlan və bəyəndiyinə səs ver', 'section' => 'videos', 'label' => 'Alt başlıq'],

            // ===== RULES =====
            ['key' => 'rules_tag', 'value' => 'Necə iştirak etməli?', 'section' => 'rules', 'label' => 'Tag mətni'],
            ['key' => 'rules_title', 'value' => 'Müsabiqə qaydaları', 'section' => 'rules', 'label' => 'Başlıq'],
            ['key' => 'rules_subtitle', 'value' => 'İştirak et. İlham ver. Təəccübləndir.', 'section' => 'rules', 'label' => 'Alt başlıq'],

            // ===== APPLY =====
            ['key' => 'apply_tag', 'value' => 'Qeydiyyat', 'section' => 'apply', 'label' => 'Tag mətni'],
            ['key' => 'apply_title', 'value' => 'İştirak et', 'section' => 'apply', 'label' => 'Başlıq'],
            ['key' => 'apply_subtitle', 'value' => 'İstedadını əks etdirən qısa video hazırla, formanı doldur və videonu yüklə. Son müraciət tarixi: <strong>20.02.2026</strong>', 'section' => 'apply', 'label' => 'Alt başlıq'],
            ['key' => 'apply_label_first_name', 'value' => 'Ad', 'section' => 'apply', 'label' => 'Form: Ad label'],
            ['key' => 'apply_placeholder_first_name', 'value' => 'Adınız', 'section' => 'apply', 'label' => 'Form: Ad placeholder'],
            ['key' => 'apply_label_last_name', 'value' => 'Soyad', 'section' => 'apply', 'label' => 'Form: Soyad label'],
            ['key' => 'apply_placeholder_last_name', 'value' => 'Soyadınız', 'section' => 'apply', 'label' => 'Form: Soyad placeholder'],
            ['key' => 'apply_label_company', 'value' => 'Şirkət / Departament', 'section' => 'apply', 'label' => 'Form: Şirkət label'],
            ['key' => 'apply_placeholder_company', 'value' => 'Şirkətinizi seçin', 'section' => 'apply', 'label' => 'Form: Şirkət placeholder'],
            ['key' => 'apply_label_department', 'value' => 'Departament', 'section' => 'apply', 'label' => 'Form: Departament label'],
            ['key' => 'apply_placeholder_department', 'value' => 'Məs: Marketing, IT, HR...', 'section' => 'apply', 'label' => 'Form: Departament placeholder'],
            ['key' => 'apply_label_title', 'value' => 'Çıxışın adı', 'section' => 'apply', 'label' => 'Form: Çıxış adı label'],
            ['key' => 'apply_placeholder_title', 'value' => 'Məs: Gitara ilə akustik ifa', 'section' => 'apply', 'label' => 'Form: Çıxış adı placeholder'],
            ['key' => 'apply_label_description', 'value' => 'Qısa təsvir', 'section' => 'apply', 'label' => 'Form: Təsvir label'],
            ['key' => 'apply_placeholder_description', 'value' => 'Çıxışınız haqqında bir neçə cümlə yazın...', 'section' => 'apply', 'label' => 'Form: Təsvir placeholder'],
            ['key' => 'apply_label_video', 'value' => 'Video fayl', 'section' => 'apply', 'label' => 'Form: Video label'],
            ['key' => 'apply_file_upload_text', 'value' => 'Videonu buraya sürükləyin və ya <strong>seçin</strong>', 'section' => 'apply', 'label' => 'Form: Fayl yükləmə mətni'],
            ['key' => 'apply_file_upload_hint', 'value' => 'Yalnız MP4 format — maks. 500MB, maks. 3 dəqiqə, minimum HD', 'section' => 'apply', 'label' => 'Form: Fayl yükləmə ipucu'],
            ['key' => 'apply_submit_btn', 'value' => 'Göndər', 'section' => 'apply', 'label' => 'Form: Göndər düyməsi'],
            ['key' => 'apply_success_title', 'value' => 'Müraciətiniz qəbul olundu!', 'section' => 'apply', 'label' => 'Uğurlu müraciət başlığı'],
            ['key' => 'apply_success_message', 'value' => 'Təşkilat komitəsi sizinlə əlaqə saxlayacaq', 'section' => 'apply', 'label' => 'Uğurlu müraciət mesajı'],

            // ===== FOOTER =====
            ['key' => 'footer_tagline', 'value' => 'İstedadını Göstər! &mdash; Global Media Group şirkətdaxili istedad müsabiqəsi', 'section' => 'footer', 'label' => 'Alt hissə şüarı'],
            ['key' => 'footer_copyright', 'value' => '&copy; 2026 Global Media Group. Bütün hüquqlar qorunur.', 'section' => 'footer', 'label' => 'Müəlliflik hüququ'],
            ['key' => 'footer_link', 'value' => 'gmg.gasimov.az', 'section' => 'footer', 'label' => 'Alt hissə: link mətni'],

            // ===== MODAL =====
            ['key' => 'modal_like_btn', 'value' => 'Bəyən', 'section' => 'modal', 'label' => 'Bəyən düyməsi'],
            ['key' => 'modal_like_btn_liked', 'value' => 'Bəyənildi', 'section' => 'modal', 'label' => 'Bəyənildi mətni'],
            ['key' => 'modal_votes_suffix', 'value' => 'səs', 'section' => 'modal', 'label' => 'Səs sayı suffiksi'],
            ['key' => 'modal_jury_btn', 'value' => 'Qiymətləndir', 'section' => 'modal', 'label' => 'Jury düyməsi'],
            ['key' => 'modal_jury_score_suffix', 'value' => 'bal', 'section' => 'modal', 'label' => 'Jury bal suffiksi'],
            ['key' => 'modal_email_gate_text', 'value' => 'Səsinizi qeyd etmək üçün e-poçt ünvanınızı daxil edin', 'section' => 'modal', 'label' => 'E-poçt gate mətni'],
            ['key' => 'modal_email_placeholder', 'value' => 'ad@global-media.az', 'section' => 'modal', 'label' => 'E-poçt placeholder'],
            ['key' => 'modal_email_submit', 'value' => 'Səs ver', 'section' => 'modal', 'label' => 'Səs ver düyməsi'],
            ['key' => 'modal_already_voted_title', 'value' => 'Artıq səs vermişsiniz', 'section' => 'modal', 'label' => 'Artıq səs: başlıq'],
            ['key' => 'modal_already_voted_message', 'value' => 'Bu e-poçt ilə bu videoya artıq səs vermişsiniz', 'section' => 'modal', 'label' => 'Artıq səs: mesaj'],
            ['key' => 'modal_vote_denied_title', 'value' => 'İcazə verilmir', 'section' => 'modal', 'label' => 'Rədd: başlıq'],
            ['key' => 'modal_vote_denied_message', 'value' => 'Bu e-poçt domeni ilə səs vermək mümkün deyil', 'section' => 'modal', 'label' => 'Rədd: mesaj'],
            ['key' => 'modal_vote_success_title', 'value' => 'Təşəkkürlər!', 'section' => 'modal', 'label' => 'Uğurlu səs: başlıq'],
            ['key' => 'modal_vote_success_message', 'value' => 'Səsiniz uğurla qeydə alındı', 'section' => 'modal', 'label' => 'Uğurlu səs: mesaj'],
            ['key' => 'modal_sending', 'value' => 'Göndərilir...', 'section' => 'modal', 'label' => 'Göndərilir mətni'],

            // ===== JURY =====
            ['key' => 'jury_login_title', 'value' => 'Münsiflər Heyəti', 'section' => 'jury', 'label' => 'Giriş: başlıq'],
            ['key' => 'jury_login_desc', 'value' => 'Qiymətləndirmə panelinə daxil olmaq üçün məlumatlarınızı daxil edin', 'section' => 'jury', 'label' => 'Giriş: təsvir'],
            ['key' => 'jury_login_email_placeholder', 'value' => 'E-poçt ünvanı', 'section' => 'jury', 'label' => 'Giriş: e-poçt placeholder'],
            ['key' => 'jury_login_password_placeholder', 'value' => 'Şifrə', 'section' => 'jury', 'label' => 'Giriş: şifrə placeholder'],
            ['key' => 'jury_login_submit', 'value' => 'Daxil ol', 'section' => 'jury', 'label' => 'Giriş: düymə'],
            ['key' => 'jury_login_error', 'value' => 'E-poçt və ya şifrə yanlışdır. Yenidən cəhd edin.', 'section' => 'jury', 'label' => 'Giriş: xəta mesajı'],
            ['key' => 'jury_login_loading', 'value' => 'Yüklənir...', 'section' => 'jury', 'label' => 'Giriş: yüklənir mətni'],
            ['key' => 'jury_dashboard_title', 'value' => 'Münsiflər Heyəti Paneli', 'section' => 'jury', 'label' => 'Panel: başlıq'],
            ['key' => 'jury_badge_label', 'value' => 'Münsif', 'section' => 'jury', 'label' => 'Panel: badge mətni'],
            ['key' => 'jury_logout_btn', 'value' => 'Çıxış', 'section' => 'jury', 'label' => 'Panel: çıxış düyməsi'],
            ['key' => 'jury_stat_total', 'value' => 'Ümumi iştirakçı', 'section' => 'jury', 'label' => 'Stat: ümumi'],
            ['key' => 'jury_stat_rated', 'value' => 'Qiymətləndirildi', 'section' => 'jury', 'label' => 'Stat: qiymətləndirildi'],
            ['key' => 'jury_stat_avg', 'value' => 'Orta bal', 'section' => 'jury', 'label' => 'Stat: orta bal'],
            ['key' => 'jury_rated_badge', 'value' => 'Qiymətləndirildi', 'section' => 'jury', 'label' => 'Kart: qiymətləndirildi badge'],
            ['key' => 'jury_rate_btn', 'value' => 'Qiymətləndir', 'section' => 'jury', 'label' => 'Kart: qiymətləndir düyməsi'],
            ['key' => 'jury_rating_avg_label', 'value' => 'Orta bal', 'section' => 'jury', 'label' => 'Rating: orta bal label'],
            ['key' => 'jury_rating_submit', 'value' => 'Qiymətləndir', 'section' => 'jury', 'label' => 'Rating: göndər düyməsi'],
            ['key' => 'jury_rating_success_title', 'value' => 'Qiymət uğurla qeydə alındı!', 'section' => 'jury', 'label' => 'Rating: uğurlu başlıq'],
            ['key' => 'jury_rating_success_message', 'value' => 'Bu iştirakçı üçün balınız saxlanıldı', 'section' => 'jury', 'label' => 'Rating: uğurlu mesaj'],
            ['key' => 'jury_criteria_skill', 'value' => 'İstedad və bacarıq səviyyəsi', 'section' => 'jury', 'label' => 'Kriteriya: istedad'],
            ['key' => 'jury_criteria_originality', 'value' => 'Orijinallıq və yaradıcı yanaşma', 'section' => 'jury', 'label' => 'Kriteriya: orijinallıq'],
            ['key' => 'jury_criteria_presentation', 'value' => 'Təqdimat bacarığı', 'section' => 'jury', 'label' => 'Kriteriya: təqdimat'],
            ['key' => 'jury_criteria_uniqueness', 'value' => 'İdeyanın unikallığı', 'section' => 'jury', 'label' => 'Kriteriya: unikallıq'],
            ['key' => 'jury_criteria_impact', 'value' => 'Ümumi performans və təsir gücü', 'section' => 'jury', 'label' => 'Kriteriya: təsir'],
            ['key' => 'jury_score_label', 'value' => 'Bal:', 'section' => 'jury', 'label' => 'Kart: bal labeli'],

            // ===== MODAL (additional) =====
            ['key' => 'modal_video_loading', 'value' => 'Video yüklənəcək...', 'section' => 'modal', 'label' => 'Video yüklənir mətni'],

            // ===== ERRORS =====
            ['key' => 'error_generic', 'value' => 'Xəta baş verdi', 'section' => 'modal', 'label' => 'Ümumi xəta mesajı'],
            ['key' => 'error_prefix', 'value' => 'Xəta: ', 'section' => 'modal', 'label' => 'Xəta prefiksi'],
            ['key' => 'error_submission', 'value' => 'Göndərmə xətası: ', 'section' => 'modal', 'label' => 'Göndərmə xətası prefiksi'],
            ['key' => 'error_invalid_format', 'value' => 'Yalnız MP4 formatında video yükləyə bilərsiniz', 'section' => 'apply', 'label' => 'Format xətası mesajı'],
        ];

        foreach ($texts as $text) {
            SiteText::updateOrCreate(
                ['key' => $text['key']],
                $text,
            );
        }
    }
}
