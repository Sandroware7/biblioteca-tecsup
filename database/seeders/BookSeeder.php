<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $realBooks = [
            ['title' => 'Clean Code: A Handbook of Agile Software Craftsmanship', 'author' => 'Robert C. Martin'],
            ['title' => 'The Pragmatic Programmer', 'author' => 'Andrew Hunt & David Thomas'],
            ['title' => 'Design Patterns: Elements of Reusable Object-Oriented Software', 'author' => 'Erich Gamma et al.'],
            ['title' => 'Refactoring', 'author' => 'Martin Fowler'],
            ['title' => 'Introduction to Algorithms (CLRS)', 'author' => 'Thomas H. Cormen'],
            ['title' => 'Cracking the Coding Interview', 'author' => 'Gayle Laakmann McDowell'],
            ['title' => 'Ingeniería de Software: Un Enfoque Práctico', 'author' => 'Roger S. Pressman'],
            ['title' => 'Code Complete', 'author' => 'Steve McConnell'],
            ['title' => 'The Mythical Man-Month', 'author' => 'Frederick P. Brooks Jr.'],
            ['title' => 'Head First Design Patterns', 'author' => 'Eric Freeman'],
            ['title' => 'You Don\'t Know JS', 'author' => 'Kyle Simpson'],
            ['title' => 'Eloquent JavaScript', 'author' => 'Marijn Haverbeke'],
            ['title' => 'Learning Python', 'author' => 'Mark Lutz'],
            ['title' => 'C# in Depth', 'author' => 'Jon Skeet'],
            ['title' => 'Java: The Complete Reference', 'author' => 'Herbert Schildt'],
            ['title' => 'Domain-Driven Design', 'author' => 'Eric Evans'],
            ['title' => 'Clean Architecture', 'author' => 'Robert C. Martin'],
            ['title' => 'Sistemas Operativos Modernos', 'author' => 'Andrew S. Tanenbaum'],

            ['title' => 'Artificial Intelligence: A Modern Approach', 'author' => 'Stuart Russell & Peter Norvig'],
            ['title' => 'Deep Learning', 'author' => 'Ian Goodfellow'],
            ['title' => 'Pattern Recognition and Machine Learning', 'author' => 'Christopher Bishop'],
            ['title' => 'Hands-On Machine Learning with Scikit-Learn, Keras, and TensorFlow', 'author' => 'Aurélien Géron'],
            ['title' => 'Life 3.0: Being Human in the Age of AI', 'author' => 'Max Tegmark'],
            ['title' => 'Superintelligence', 'author' => 'Nick Bostrom'],
            ['title' => 'Data Science for Business', 'author' => 'Foster Provost'],
            ['title' => 'The Hundred-Page Machine Learning Book', 'author' => 'Andriy Burkov'],
            ['title' => 'Python for Data Analysis', 'author' => 'Wes McKinney'],
            ['title' => 'Neural Networks and Deep Learning', 'author' => 'Michael Nielsen'],

            ['title' => 'Redes de Computadoras', 'author' => 'Andrew S. Tanenbaum'],
            ['title' => 'Data Communications and Networking', 'author' => 'Behrouz A. Forouzan'],
            ['title' => 'Principios de Electrónica', 'author' => 'Albert Malvino'],
            ['title' => 'Dispositivos Electrónicos', 'author' => 'Thomas L. Floyd'],
            ['title' => 'Microelectronic Circuits', 'author' => 'Adel S. Sedra'],
            ['title' => 'Sistemas Digitales', 'author' => 'Ronald J. Tocci'],
            ['title' => 'Arduino Project Handbook', 'author' => 'Mark Geddes'],
            ['title' => 'PLC Programming for Industrial Automation', 'author' => 'Kevin Collins'],
            ['title' => 'Mecatrónica: Sistemas de Control Electrónico', 'author' => 'W. Bolton'],
            ['title' => 'Termodinámica', 'author' => 'Yunus A. Cengel'],

            ['title' => 'The Lean Startup', 'author' => 'Eric Ries'],
            ['title' => 'Scrum: The Art of Doing Twice the Work in Half the Time', 'author' => 'Jeff Sutherland'],
            ['title' => 'Sprint', 'author' => 'Jake Knapp'],
            ['title' => 'Atomic Habits', 'author' => 'James Clear'],
            ['title' => 'Deep Work', 'author' => 'Cal Newport'],
            ['title' => 'Zero to One', 'author' => 'Peter Thiel'],
            ['title' => 'Start with Why', 'author' => 'Simon Sinek'],
            ['title' => 'The Phoenix Project', 'author' => 'Gene Kim'],
            ['title' => 'Administración de Proyectos', 'author' => 'PMBOK Guide'],
        ];

        foreach ($realBooks as $bookData) {
            Book::create([
                'title' => $bookData['title'],
                'author' => $bookData['author'],
                'stock' => rand(2, 10),

                'year' => rand(1995, 2024),
            ]);
        }

        $currentCount = count($realBooks);
        $remaining = 250 - $currentCount;

        if ($remaining > 0) {
            Book::factory()->count($remaining)->create();
        }
    }
}
