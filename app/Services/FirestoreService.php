<?php
namespace App\Services;

use Kreait\Firebase\Factory;
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Core\Exception\GoogleException;

class FirestoreService
{
    protected $db;

    public function __construct()
    {
        $this->db = (new Factory)
            ->withServiceAccount(storage_path('app/firebase_credentials.json'))
            ->createFirestore()
            ->database(); // ✅ Cette fois c’est bon ici
    }

    public function storeFormation($formation): bool
    {
        try {
            $this->db
                ->collection('formations')
                ->document((string) $formation->id)
                ->set([
                    'titre' => $formation->titre,
                    'description' => $formation->description,
                    'date_debut' => $formation->date_debut,
                    'date_fin' => $formation->date_fin,
                    'nbr_place' => $formation->nbr_place,
                    'type' => $formation->type,
                    'formateur' => $formation->formateur,
                    'created_at' => now()->toDateTimeString(),
                ]);

            return true;
        } catch (GoogleException $e) {
            \Log::error('Erreur Firestore : ' . $e->getMessage());
            return false;
        }
    }

    public function deleteFormation($id): void
    {
        $this->db
            ->collection('formations')
            ->document((string) $id)
            ->delete();
    }
    public function storeEmployee($employee): bool
    {
        try {
            $this->db
                ->collection('users')
                ->document((string) $employee['id']) // Utilisation de l'ID Laravel
                ->set([
                    'nom' => $employee['nom'],
                    'prenom' => $employee['prenom'],
                    'email' => $employee['email'],
                    'role' => $employee['role'],
                    'poste' => $employee['poste'],
                    'dateEmbauche' => $employee['dateEmbauche'],
                    'entreprise_id' => $employee['entreprise_id'],
                    'account_status' => $employee['account_status'],
                    'created_at' => now()->toDateTimeString(),
                ]);
    
            return true;
        } catch (\Google\Cloud\Core\Exception\GoogleException $e) {
            \Log::error('Erreur Firestore employé : ' . $e->getMessage());
            return false;
        }
    }
    public function deleteEmployee($id): void
{
    $this->db
        ->collection('users')
        ->document((string) $id)
        ->delete();
}

    

}
