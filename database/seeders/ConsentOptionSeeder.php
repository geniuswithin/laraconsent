<?php

namespace Ekoukltd\LaraConsent\Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Ekoukltd\LaraConsent\Models\ConsentOption;
use Illuminate\Database\Seeder;

class ConsentOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConsentOption::factory()
            ->createMany([
                             [
                                 'key'          => 'terms-and-conditions',
                                 'version'      => 1,
                                 'title'        => 'GDPR Terms and condtions',
                                 'label'        => 'Click here to accept the data collection terms',
                                 'sort_order'   => 1,
                                 'enabled'    => 1,
                                 'text'         => '<p>In order to receive services you must consent to our standard data collection and sharing statements:</p>
<ul class="fa-ul">
<li><i class="fa-li fa fa-check-square"></i> I agree to the company collecting personal data to be able to deliver my service as per my order. </li>
<li><i class="fa-li fa fa-check-square"></i> I agree to undertake the service ordered.</li>
<li><i class="fa-li fa fa-check-square"></i> I agree to sharing my details &amp; outputs of services with my designated coach. </li>
<li><i class="fa-li fa fa-check-square"></i> I agree to any digitally delivered sessions being recorded for internal quality control, training, &amp; monitoring purposes.</li>
<li><i class="fa-li fa fa-check-square"></i> If I am unable to attend a session, I will let my coach know immediately. If it is less than 48 hours’ notice I am aware that I may lose my session in accordance with the 48-hour cancellation policy.</li>
</ul>',
                                 'is_mandatory' => true,
                                 'is_current'   => true
                             ],
                             [
                                 'key'          => 'data-sharing',
                                 'version'      => 1,
                                 'title'        => 'Data Sharing',
                                 'label'        => 'Optionally click here to accept the data sharing terms',
                                 'sort_order'   => 2,
                                 'enabled'    => 1,
                                 'text'         => '<ul class="fa-ul">
<li><i class="fa-li fa fa-check-square"></i>
I agree to sharing my reports with my organisation, manager, or referral company to facilitate ongoing support.</li>
<li><i class="fa-li fa fa-check-square"></i> I understand that my reports may contain medical history or outcome of a diagnosis &amp; I agree that this is shared with appropriate persons.</li>
</ul>',
                                 'is_mandatory' => false,
                                 'is_current'   => true,
                             ],
                
                             [
                                 'key'          => 'health-safety-security',
                                 'version'      => 1,
                                 'title'        => 'My Health, Safety and Security',
                                 'sort_order'   => 3,
                                 'enabled'    => 1,
                                 'text'         => '<ul class="fa-ul">
<li><i class="fa-li fa fa-check-square"></i>
I understand &amp; agree that my service is for workplace needs support only &amp; that my coach will maintain the appropriate boundaries or will advise that I seek support from another professional should I require mediation, counselling, or other types of support. </li>
<li><i class="fa-li fa fa-check-square"></i> I understand &amp; agree that in the event of my emotional or physical safety or the safety of others being at risk, my coach will support me by contacting my emergency contact detailed below.</li>
<li><i class="fa-li fa fa-check-square"></i> I agree to protect my personal data &amp; I will change any passwords that may be given to me to one which is personal to me. I understand that the company cannot be held responsible for any breach of data protection resulting from failure to change my password.</li></ul>',
                                 'label'        => 'Click here to accept the heath and safety terms',
                                 'is_mandatory' => true,
                                 'is_current'   => true,
                             ],
                
                             [
                                 'key'          => 'research-sharing',
                                 'version'      => 1,
                                 'title'        => 'Sharing for Research',
                                 'text'         => 'I understand & agree that my data may be anonymised & used to support research.',
                                 'sort_order'   => 4,
                                 'enabled'    => 1,
                                 'label'        => 'Optionally tick here to accept the data sharing terms',
                                 'is_mandatory' => false,
                                 'is_current'   => true,
                             ],
            
                         ]);

        $user          = User::findOrFail(1);
        $admin         = Admin::findOrFail(1);
        $consentOption = ConsentOption::findOrFail(1);
        $user->consents()
            ->save($consentOption, [
                'accepted' => true,
                'key'      => $consentOption->key
            ]);
        $admin->consents()->save($consentOption, [
            'accepted' => true,
            'key'      => $consentOption->key
        ]);
    }
}
