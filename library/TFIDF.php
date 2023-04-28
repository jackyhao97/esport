<?php
  class TFIDF
  {
      private $corpus;
      private $terms;
      private $tfidf;

      public function __construct($corpus)
      {
          $this->corpus = $corpus;
          $this->terms = $this->getTerms($corpus);
          $this->calculateTFIDF();
      }

      private function getTerms($corpus)
      {
          // Tokenize the corpus into terms
          $terms = array();
          $tokens = explode(" ", $corpus);
          foreach ($tokens as $token) {
              $term = strtolower(trim($token));
              if (!empty($term)) {
                  $terms[] = $term;
              }
          }
          return $terms;
      }

      private function countTermFrequency($term)
      {
          // Count the term frequency (TF) in the corpus
          $termFrequency = 0;
          foreach ($this->terms as $termInCorpus) {
              if ($term == $termInCorpus) {
                  $termFrequency++;
              }
          }
          return $termFrequency;
      }

      private function countDocumentFrequency($term)
      {
          // Count the document frequency (DF) of a term in the corpus
          $documentFrequency = 0;
          foreach ($this->terms as $termInCorpus) {
              if ($term == $termInCorpus) {
                  $documentFrequency++;
              }
          }
          return $documentFrequency;
      }

      private function calculateTFIDF()
      {
          $totalTerms = count($this->terms); //hitung jumlah item didalam array
          $uniqueTerms = array_unique($this->terms); //remove duplicate values dari array $this->terms
          foreach ($uniqueTerms as $term) {
                // Hitung TF (TF atau Term Frequency adalah jumlah kemunculan kata yang bersangkutan dalam dokumen tersebut)
              $termFrequency = $this->countTermFrequency($term);
                // Hitung DF (DF atau Document Frequency adalah total kemunculan kata yang ada dalam dokumen tersebut)
              $documentFrequency = $this->countDocumentFrequency($term);
                // Hitung IDF (Inverse Document Frequency)
              $inverseDocumentFrequency = log10($totalTerms / $documentFrequency);
                // Hitung bobot masing-masing dokumen yang ada
              $this->tfidf[$term] = $termFrequency * $inverseDocumentFrequency;
          }
      }

      public function getTFIDF()
      {
          return $this->tfidf;
      }
  }
?>