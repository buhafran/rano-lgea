<?php

namespace Database\Seeders;

use App\Models\IndicatorDefinition;
use Illuminate\Database\Seeder;

class IndicatorDefinitionSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['code' => 'GER', 'name' => 'Gross Enrolment Ratio', 'description' => 'Total enrolment in primary education regardless of age as a percentage of the official school-age population.', 'formula' => '(Total enrolment in primary / official primary school-age population) * 100', 'level' => 'lga', 'data_type' => 'percentage', 'is_calculated' => true],
            ['code' => 'NER', 'name' => 'Net Enrolment Rate', 'description' => 'Enrolment of pupils within the official primary school-age group expressed as a percentage of the same age population.', 'formula' => '(Enrolment age 6-11 in primary / population age 6-11) * 100', 'level' => 'lga', 'data_type' => 'percentage', 'is_calculated' => true],
            ['code' => 'GIR', 'name' => 'Gross Intake Ratio', 'description' => 'New entrants into first grade regardless of age as a percentage of official entry-age population.', 'formula' => '(New entrants to grade 1 / population age 6) * 100', 'level' => 'lga', 'data_type' => 'percentage', 'is_calculated' => true],
            ['code' => 'NIR', 'name' => 'Net Intake Rate', 'description' => 'New entrants into first grade who are of official entry age as a percentage of same-age population.', 'formula' => '(New entrants age 6 to grade 1 / population age 6) * 100', 'level' => 'lga', 'data_type' => 'percentage', 'is_calculated' => true],
            ['code' => 'CR', 'name' => 'Completion Rate', 'description' => 'New entrants into the last grade of primary regardless of age as a percentage of population at official last-grade age.', 'formula' => '(Entrants to last grade / population at official age for last grade) * 100', 'level' => 'lga', 'data_type' => 'percentage', 'is_calculated' => true],
            ['code' => 'GPI', 'name' => 'Gender Parity Index', 'description' => 'Ratio of female to male values for a given education indicator.', 'formula' => 'Female value / Male value', 'level' => 'lga', 'data_type' => 'ratio', 'is_calculated' => true],
            ['code' => 'PTR', 'name' => 'Pupil–Teacher Ratio', 'description' => 'Average number of pupils per teacher.', 'formula' => 'Total pupils / Total teachers', 'level' => 'school', 'data_type' => 'ratio', 'is_calculated' => true],
            ['code' => 'DRG', 'name' => 'Dropout Rate by Grade', 'description' => 'Percentage of pupils in a grade who are not enrolled in the following year.', 'formula' => '(Dropouts from grade cohort / total grade cohort) * 100', 'level' => 'school', 'data_type' => 'percentage', 'is_calculated' => true],
            ['code' => 'RRG', 'name' => 'Repetition Rate by Grade', 'description' => 'Percentage of pupils in a grade who repeat the same grade the following year.', 'formula' => '(Repeaters in grade / total enrolled in grade) * 100', 'level' => 'school', 'data_type' => 'percentage', 'is_calculated' => true],
            ['code' => 'PQT', 'name' => 'Percentage of Qualified Teachers', 'description' => 'Qualified teachers as a percentage of all teachers.', 'formula' => '(Qualified teachers / total teachers) * 100', 'level' => 'school', 'data_type' => 'percentage', 'is_calculated' => true],
            ['code' => 'PFT', 'name' => 'Percentage of Female Teachers', 'description' => 'Female teachers as a percentage of total teachers.', 'formula' => '(Female teachers / total teachers) * 100', 'level' => 'school', 'data_type' => 'percentage', 'is_calculated' => true],
            ['code' => 'PPE', 'name' => 'Percentage of Private Enrolment', 'description' => 'Private enrolment as a percentage of total enrolment.', 'formula' => '(Private enrolment / total enrolment) * 100', 'level' => 'lga', 'data_type' => 'percentage', 'is_calculated' => true],
            ['code' => 'TR', 'name' => 'Transition Rate', 'description' => 'Students admitted to first grade of higher level as a percentage of final grade of preceding level in previous year.', 'formula' => '(Entrants to next level / final grade enrolment previous level) * 100', 'level' => 'lga', 'data_type' => 'percentage', 'is_calculated' => true],
        ] as $indicator) {
            IndicatorDefinition::updateOrCreate(
                ['code' => $indicator['code']],
                $indicator
            );
        }
    }
}