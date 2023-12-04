<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_index_returns_all_orders()
    // {

    //     $user = User::factory()->create(['user_type' => 1]);
    //     $this->actingAs($user);

    //     // Arrange
    //     $expectedOrders = Order::all();

    //     // Act
    //     $actualOrders = $this->get(route('admin.orders.index'));

    //     // Assert
    //     $actualOrders->assertStatus(200);
    //     $actualOrders->assertJsonFragment(['data' => $expectedOrders->toArray()]);
    // }


    // public function test_show_returns_specific_order()
    // {
    //     $user = User::factory()->create(['user_type' => 1]);
    //     $this->actingAs($user);
    //     // Arrange
    //     $order = Order::first();

    //     // Act
    //     $response = $this->get(route('admin.orders.show', ['order_id' => $order->order_id]));

    //     // Assert
    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.order.invoice_order');
    //     $response->assertViewHas('orderData', $order);
    //     $response->assertViewHas('billingInfo', $order->billingInformation);
    //     $response->assertViewHas('orderItem', $order->orderItems);
    // }
}
