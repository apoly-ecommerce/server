<?php

namespace App\Common;

trait Feedbackable
{
    /**
     * Check if model has any feedbacks.
     *
     * @return bool
     */
     public function hasFeedback() : bool
     {
        return (bool) $this->feedbacks()->count();
     }

     /**
      * Return collection of Feedbacks related to the replied model
      *
      * @return Illuminate\Database\Eloquent\Collection
      */
      public function feedbacks()
      {
          return $this->morphMany(\App\Models\Feedback::class, 'feedbackable');
      }

      /**
       * Get the Model's Average Feedback.
       */
      public function averageFeedback()
      {
          return $this->feedbacks()->avg('rating');
      }

      /**
       * Get the Model's Rating
       */
      public function rating()
      {
          $rating = $this->averageFeedback();
          $dec = ((int) $rating == $rating) ? 0 : 1;

          return ceil($rating) ? number_format($rating, $dec) : null;
      }

      /**
       * Get sum for all feedback
       */
      public function sumFeedback()
      {
          return $this->feedbacks()->sum('rating');
      }

      /**
       * Deletes all the feedback of this model.
       *
       * @return bool
       */
      public function flushFeedbacks()
      {
          return $this->feedbacks()->delete();
      }
}