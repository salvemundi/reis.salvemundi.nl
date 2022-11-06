<?php

namespace Database\Seeders;

use App\Enums\SettingTypes;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

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
        if(!Setting::where('name','SignupPageEnabled')->exists()) {
            $setting = new Setting();
            $setting->name = "SignupPageEnabled";
            $setting->value = "true";
            $setting->description = "Zet de vrijblijvende inschrijf pagina aan of uit.";
            $setting->valueType = SettingTypes::boolean();
            $setting->save();
        }

        // Payment page
        if(!Setting::where('name', 'ConfirmationEnabled')->exists()) {
            $setting = new Setting();
            $setting->name = "ConfirmationEnabled";
            $setting->value = "true";
            $setting->description = "Zet de betalings pagina aan of uit.";
            $setting->valueType = SettingTypes::boolean();
            $setting->save();
        }

        // Send automatic mails after opening date
        if(!Setting::where('name', 'AutoSendPaymentEmailDate')->exists()) {
            $setting = new Setting();
            $setting->name = "AutoSendPaymentEmailDate";
            $setting->value = new Carbon('2025-06-14');
            $setting->description = "Stel de datum in waarop de betalings email automatisch wordt verzonden.";
            $setting->valueType = SettingTypes::date();
            $setting->save();
        }
    }
}
