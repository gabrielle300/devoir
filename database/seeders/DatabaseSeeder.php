<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
      
        DB::table('notes')->truncate();
        DB::table('evaluations')->truncate();
        DB::table('etudiants')->truncate();
        
      
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

       
        $etudiants = [
            [
                'id' => 1,
                'prenom' => 'SAGNA',
                'nom' => 'yoyo',
                'date_naissance' => '2002-03-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'prenom' => 'Fatima',
                'nom' => 'GAYE',
                'date_naissance' => '2001-07-22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'prenom' => 'Mohamed',
                'nom' => 'doip',
                'date_naissance' => '2002-11-08',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'prenom' => 'christine',
                'nom' => 'sagna',
                'date_naissance' => '2001-12-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('etudiants')->insert($etudiants);

        
        $evaluations = [
            [
                'id' => 1,
                'titre' => 'Examen de Mathématiques',
                'date' => '2024-01-15',
                'type' => 'examen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'titre' => 'Devoir de Physique',
                'date' => '2024-01-20',
                'type' => 'devoir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'titre' => 'Examen de Français',
                'date' => '2024-01-25',
                'type' => 'examen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('evaluations')->insert($evaluations);

    
        $notes = [
            
            ['etudiant_id' => 1, 'evaluation_id' => 1, 'note' => 15.50, 'created_at' => now(), 'updated_at' => now()],
            ['etudiant_id' => 2, 'evaluation_id' => 1, 'note' => 17.75, 'created_at' => now(), 'updated_at' => now()],
            ['etudiant_id' => 3, 'evaluation_id' => 1, 'note' => 12.25, 'created_at' => now(), 'updated_at' => now()],
            ['etudiant_id' => 4, 'evaluation_id' => 1, 'note' => 18.00, 'created_at' => now(), 'updated_at' => now()],
            
           
            ['etudiant_id' => 1, 'evaluation_id' => 2, 'note' => 14.00, 'created_at' => now(), 'updated_at' => now()],
            ['etudiant_id' => 2, 'evaluation_id' => 2, 'note' => 16.50, 'created_at' => now(), 'updated_at' => now()],
            ['etudiant_id' => 3, 'evaluation_id' => 2, 'note' => 13.75, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('notes')->insert($notes);

        echo "✅ Données de test insérées avec succès !\n";
        echo "📊 4 étudiants, 3 évaluations, 7 notes créées\n";
    }
}
