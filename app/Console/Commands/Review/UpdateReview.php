<?php

namespace App\Console\Commands\Review;

use Illuminate\Console\Command;
use File, DB, Log;
use App\Model\Order;
use App\Model\Service;
use App\Model\Transaction;
use App\Model\Download;
use App\Model\Theme;
use App\Model\EmailJob;
use App\Libraries\Helpers, WebService;
use App\Mail\QueueEmail;
use App\User;
use Mail;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\CashFlow\CashFlowRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\ServiceReview\ServiceReviewRepositoryInterface;

class UpdateReview extends Command
{
    protected $orderRepository;
    protected $cashFlowRepository;
    protected $userRepository;
    protected $serviceRepository;
    protected $serviceReviewRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'systems:update-review';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Review';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ServiceReviewRepositoryInterface $serviceReviewRepository, ServiceRepositoryInterface $serviceRepository, OrderRepositoryInterface $orderRepository, CashFlowRepositoryInterface $cashFlowRepository, UserRepositoryInterface $userRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->cashFlowRepository = $cashFlowRepository;
        $this->userRepository = $userRepository;
        $this->serviceRepository = $serviceRepository;
        $this->serviceReviewRepository = $serviceReviewRepository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $items = $this->serviceRepository->getService();
            Log::notice('call systems:update-review');
            if (count($items) > 0) {
                foreach ($items as $key => $item) {
                    $service_id = $item->id;
                    $rating = $this->serviceReviewRepository->ratingService($service_id);
                    $round = -1;
                    if ($rating) {
                        if ($rating->rating) {
                            $review = $rating->rating / $rating->count;
                            $round = (round($review*10))/10;
                        }
                    }
                    $html = '<a href="/review-servive/'.$service_id.'" class="review-client" data-id="' . $service_id . '">';
                    for ($i = 0; $i < 5; $i++) {
                        $text = $round > $i ? 'text-warning' : '';
                        $html .= '<i class="fas fa-star ' . $text . ' mr-1"></i> ';
                    }
                    $html .= '</a> ('.$round.')';
                    $review = $this->serviceReviewRepository->findServiceReview($service_id);
                    $reviews = (json_encode($review));
                    $item->update(['quality' => $html, 'reviews'=>$reviews]);
                }
            }
        } catch (\Exception $e) {
            Log::error('UpdateReview :'.$e->getMessage());
        }
        
    }
}
