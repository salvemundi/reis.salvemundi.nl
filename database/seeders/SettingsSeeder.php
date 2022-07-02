<?php

namespace Database\Seeders;

use App\Enums\SettingTypes;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Signup page
        if(Setting::find('SignupPageEnabled') == null) {
            $setting = new Setting();
            $setting->name = "SignupPageEnabled";
            $setting->value = (bool)"true";
            $setting->description = "Zet de vrijblijvende inschrijf pagina aan of uit.";
            $setting->valueType = SettingTypes::boolean();
            $setting->save();
        }

        // Payment page
        if(Setting::find('ConfirmationEnabled') == null) {
            $setting = new Setting();
            $setting->name = "ConfirmationEnabled";
            $setting->value = "true";
            $setting->description = "Zet de betalings pagina aan of uit.";
            $setting->valueType = SettingTypes::boolean();
            $setting->save();
        }

        // Send automatic mails after opening date
        if(Setting::find('AutoSendPaymentEmailDate') == null) {
            $setting = new Setting();
            $setting->name = "AutoSendPaymentEmailDate";
            $setting->value = new Carbon('2022-06-14');
            $setting->description = "Stel de datum in waarop de betalings email automatisch wordt verzonden.";
            $setting->valueType = SettingTypes::date();
            $setting->save();
        }
    }
}
