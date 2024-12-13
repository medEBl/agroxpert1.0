<?php

class Order {
    private ?int $id_order;
    private ?int $id_user;
    private ?float $total_price;
    private ?string $order_date;
    private ?string $status;

    public function __construct(?int $id_order = null, ?int $id_user = null, ?float $total_price = null, ?string $status = 'Pending') {
        $this->id_order = $id_order;
        $this->id_user = $id_user;
        $this->total_price = $total_price;
        $this->status = $status;
    }

    public function getIdOrder(): ?int { return $this->id_order; }
    public function getIdUser(): ?int { return $this->id_user; }
    public function getTotalPrice(): ?float { return $this->total_price; }
    public function getOrderDate(): ?string { return $this->order_date; }
    public function getStatus(): ?string { return $this->status; }

    public function setIdOrder(?int $id_order): void { $this->id_order = $id_order; }
    public function setIdUser(?int $id_user): void { $this->id_user = $id_user; }
    public function setTotalPrice(?float $total_price): void { $this->total_price = $total_price; }
    public function setStatus(?string $status): void { $this->status = $status; }
}
?>
