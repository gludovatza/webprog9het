<?php
class Storage {
    private $io;

    public function __construct($io) {
        $this->io = $io;
    }

    public function findAll() {
        return $this->io->read();
    }

    public function save($data) {
        $this->io->write($data);
    }
}

class JsonIO {
    private $file;

    public function __construct($file) {
        $this->file = $file;

        // Ha a fájl nem létezik, hozzuk létre üres tömbként
        if (!file_exists($file)) {
            file_put_contents($file, json_encode([]));
        }
    }

    public function read() {
        $content = file_get_contents($this->file);
        return json_decode($content, true) ?? [];
    }

    public function write($data) {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
class CardStorage extends Storage {
    public function __construct() {
        parent::__construct(new JsonIO('cards.json'));
    }
}
?>
