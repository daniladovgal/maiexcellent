<?php

namespace App\Modules\Synchronize\V1\Commands;

use App\Common\V1\Enums\ExternalOperatorEnum;
use App\Common\V1\Kernel\CommonCommand;
use App\Modules\Synchronize\V1\Services\Synchronize\SynchronizeService;

class SynchronizeByOperatorCommand extends CommonCommand
{
    public function __construct(
        private readonly SynchronizeService $synchronizeService,
    ) {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *`
     * @var string
     */
    protected $signature = 'app:synchronize-by-operator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Забирает данные у стороннего оператора и сохраняет их в бд';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->synchronizeService->synchronize(ExternalOperatorEnum::MAIEXCELLENT);
    }
}
