<?php
  class CosineSimilarity
  {
      private $tfidf1;
      private $tfidf2;
  
      public function __construct($tfidf1, $tfidf2)
      {
          $this->tfidf1 = $tfidf1;
          $this->tfidf2 = $tfidf2;
      }
  
      private function dotProduct()
      {
          // Calculate the dot product of two vectors
          $dotProduct = 0;
          foreach ($this->tfidf1 as $term => $tfidf1Score) {
              if (isset($this->tfidf2[$term])) {
                  $tfidf2Score = $this->tfidf2[$term];
                  $dotProduct += $tfidf1Score * $tfidf2Score;
              }
          }
          return $dotProduct;
      }
  
      private function euclideanNorm($vector)
      {
          // Calculate the Euclidean norm of a vector
          $sumOfSquares = 0;
          foreach ($vector as $score) {
              $sumOfSquares += $score * $score;
          }
          return sqrt($sumOfSquares);
      }
  
      public function calculateCosineSimilarity()
      {
          // Calculate the cosine similarity between two vectors
          $dotProduct = $this->dotProduct();
          $euclideanNorm1 = $this->euclideanNorm($this->tfidf1);
          $euclideanNorm2 = $this->euclideanNorm($this->tfidf2);
                  // Avoid division by zero
        if ($euclideanNorm1 == 0 || $euclideanNorm2 == 0) {
          return 0;
        }

      // Calculate the cosine similarity
      $cosineSimilarity = $dotProduct / ($euclideanNorm1 * $euclideanNorm2);
      return $cosineSimilarity;
      }
  }
