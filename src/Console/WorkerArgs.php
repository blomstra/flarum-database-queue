<?php

/*
 * This file is part of blomstra/database-queue
 *
 * Copyright (c) 2023 Blomstra Ltd.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 *
 */

namespace Blomstra\DatabaseQueue\Console;

use Flarum\Settings\SettingsRepositoryInterface;

class WorkerArgs
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function args(): array
    {
        $args = [
            '--stop-when-empty',
        ];

        $args['--tries'] = $this->settings->get('blomstra-database-queue.retries');
        $args['--timeout'] = $this->settings->get('blomstra-database-queue.timeout');
        $args['--rest'] = $this->settings->get('blomstra-database-queue.rest');
        $args['--memory'] = $this->settings->get('blomstra-database-queue.memory');
        $args['--backoff'] = $this->settings->get('blomstra-database-queue.backoff');

        return $args;
    }
}