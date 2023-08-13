<?php

declare(strict_types=1);

namespace Timuchen\SberbankAcquiring\Models;

use Timuchen\SberbankAcquiring\Traits\HasConfig;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasConfig;

    /**
     * Ключ для имени таблицы в конфигурационном файле
     *
     * @var string
     */
    protected $tableNameKey;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable($this->getTableName($this->tableNameKey));
    }
}
