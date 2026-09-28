<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryBw;
use App\Models\EventBw;
use App\Models\UserBw;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class EventsSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un admin
        $admin = UserBw::firstOrCreate(
            ['email' => 'admin@eventplanner.com'],
            [
                'name' => 'Admin EventPlanner',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Créer un utilisateur normal
        UserBw::firstOrCreate(
            ['email' => 'user@eventplanner.com'],
            [
                'name' => 'Jean Dupont',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );

        // Créer les catégories
        $categories = [
            'Conférences',
            'Ateliers',
            'Webinaires',
            'Networking',
            'Formation',
        ];

        $catModels = [];
        foreach ($categories as $name) {
            $catModels[] = CategoryBw::firstOrCreate(['name' => $name]);
        }

        // Créer les événements
        $events = [
            [
                'title' => 'Laravel Deep Dive - Les Secrets de l\'ORM Eloquent',
                'description' => 'Une conférence approfondie sur les fonctionnalités avancées de Laravel et comment maîtriser Eloquent ORM. Apprenez les meilleures pratiques, les patterns de design et comment optimiser vos requêtes.',
                'start_date' => Carbon::now()->addDays(7)->setTime(10, 0),
                'end_date' => Carbon::now()->addDays(7)->setTime(12, 0),
                'place' => 'Salle A, Tech Hub Paris',
                'price' => 49.99,
                'is_free' => false,
                'capacity' => 50,
                'status' => 'approved',
                'category_id' => $catModels[0]->id,
            ],
            [
                'title' => 'Atelier pratique: Vue.js 3 & Composition API',
                'description' => 'Un atelier intensif où vous apprendrez à construire des applications modernes avec Vue.js 3. Nous couvrirons la Composition API, les plugins, et les best practices. Amenez votre laptop!',
                'start_date' => Carbon::now()->addDays(10)->setTime(14, 0),
                'end_date' => Carbon::now()->addDays(10)->setTime(17, 0),
                'place' => 'Salle B, Tech Hub Paris',
                'price' => 0,
                'is_free' => true,
                'capacity' => 30,
                'status' => 'approved',
                'category_id' => $catModels[1]->id,
            ],
            [
                'title' => 'Webinaire: Docker & Kubernetes 101',
                'description' => 'Découvrez les bases de Docker et Kubernetes avec des démonstrations en direct. Parfait pour les débutants qui veulent améliorer leur workflow DevOps. En ligne via Zoom.',
                'start_date' => Carbon::now()->addDays(5)->setTime(18, 0),
                'end_date' => Carbon::now()->addDays(5)->setTime(19, 30),
                'place' => 'En ligne (Zoom)',
                'price' => 29.99,
                'is_free' => false,
                'capacity' => 100,
                'status' => 'approved',
                'category_id' => $catModels[2]->id,
            ],
            [
                'title' => 'Networking Event - Rencontre Tech Community Paris',
                'description' => 'Venez rencontrer les développeurs et entrepreneurs locaux dans une ambiance conviviale. Networking, discussions informelles et opportunités de collaboration. Bière et snacks inclus!',
                'start_date' => Carbon::now()->addDays(14)->setTime(18, 30),
                'end_date' => Carbon::now()->addDays(14)->setTime(21, 0),
                'place' => 'Café Tech, Centre Paris',
                'price' => 0,
                'is_free' => true,
                'capacity' => 80,
                'status' => 'approved',
                'category_id' => $catModels[3]->id,
            ],
            [
                'title' => 'Formation: React Avancé & State Management',
                'description' => 'Une formation complète sur React avec hooks, context API, et Redux. Préalable: connaître les bases de JavaScript. Certificat de participation remis à la fin.',
                'start_date' => Carbon::now()->addDays(21)->setTime(9, 0),
                'end_date' => Carbon::now()->addDays(21)->setTime(17, 0),
                'place' => 'Salle C, Tech Hub Paris',
                'price' => 199.99,
                'is_free' => false,
                'capacity' => 25,
                'status' => 'approved',
                'category_id' => $catModels[4]->id,
            ],
            [
                'title' => 'Conférence: Web Security 2026 - Les Nouvelles Menaces',
                'description' => 'Découvrez les dernières menaces en sécurité web et comment les combattre. OWASP Top 10, bonnes pratiques, et outils de sécurité modernes. Speakers: experts en cybersécurité.',
                'start_date' => Carbon::now()->addDays(28)->setTime(14, 0),
                'end_date' => Carbon::now()->addDays(28)->setTime(16, 0),
                'place' => 'Amphithéâtre, Convention Center Paris',
                'price' => 39.99,
                'is_free' => false,
                'capacity' => 200,
                'status' => 'approved',
                'category_id' => $catModels[0]->id,
            ],
            [
                'title' => 'Atelier: Introduction à TypeScript',
                'description' => 'Apprenez TypeScript de zéro ! Nous couvrirons les types de base, les interfaces, les génériques et comment l\'intégrer dans vos projets. Perfect pour les développeurs JavaScript.',
                'start_date' => Carbon::now()->addDays(12)->setTime(10, 0),
                'end_date' => Carbon::now()->addDays(12)->setTime(12, 30),
                'place' => 'Salle D, Tech Hub Paris',
                'price' => 0,
                'is_free' => true,
                'capacity' => 40,
                'status' => 'approved',
                'category_id' => $catModels[1]->id,
            ],
        ];

        foreach ($events as $event) {
            EventBw::firstOrCreate(
                ['title' => $event['title']],
                array_merge($event, ['created_by' => $admin->id])
            );
        }

        $this->command->info('✅ Événements créés avec succès!');
        $this->command->info('👤 Admin: admin@eventplanner.com / password123');
        $this->command->info('👤 User: user@eventplanner.com / password123');
    }
}
