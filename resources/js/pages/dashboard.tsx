import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/react';

interface Props {
    stats: {
        todaySales: number;
        todaySalesCount: number;
        lowStockRawMaterials: number;
        lowStockProducts: number;
        totalCustomers: number;
        totalSuppliers: number;
        totalProducts: number;
        totalRawMaterials: number;
    };
    recentSales: Array<{
        id: number;
        invoice_number: string;
        total_amount: number;
        sale_date: string;
        customer?: {
            name: string;
        };
        cashier: {
            name: string;
        };
        payment_method: string;
    }>;
    [key: string]: unknown;
}

export default function Dashboard({ stats, recentSales }: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(amount);
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        });
    };

    const quickActions = [
        { 
            title: 'New Sale', 
            icon: '🛒', 
            description: 'Process a new sale transaction',
            href: '/sales/create',
            color: 'bg-green-500'
        },
        { 
            title: 'Add Stock', 
            icon: '📦', 
            description: 'Add new inventory items',
            href: '/inventory/raw-materials/create',
            color: 'bg-blue-500'
        },
        { 
            title: 'View Reports', 
            icon: '📊', 
            description: 'Generate sales and inventory reports',
            href: '/reports',
            color: 'bg-purple-500'
        },
        { 
            title: 'Manage Products', 
            icon: '🎨', 
            description: 'Manage finished paint products',
            href: '/inventory/products',
            color: 'bg-orange-500'
        },
    ];

    return (
        <AppShell>
            <div className="p-6 space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900">
                            🎨 Toka Cat Dashboard
                        </h1>
                        <p className="text-gray-600 mt-1">
                            Welcome to your paint store management system
                        </p>
                    </div>
                    <div className="text-right">
                        <p className="text-sm text-gray-500">Today</p>
                        <p className="text-lg font-semibold text-gray-900">
                            {new Date().toLocaleDateString('id-ID', {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            })}
                        </p>
                    </div>
                </div>

                {/* Stats Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <Card className="bg-gradient-to-br from-green-50 to-green-100 border-green-200">
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium text-green-800">
                                Today's Sales
                            </CardTitle>
                            <div className="text-2xl">💰</div>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-green-900">
                                {formatCurrency(stats.todaySales)}
                            </div>
                            <p className="text-xs text-green-600 mt-1">
                                {stats.todaySalesCount} transactions today
                            </p>
                        </CardContent>
                    </Card>

                    <Card className="bg-gradient-to-br from-blue-50 to-blue-100 border-blue-200">
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium text-blue-800">
                                Total Products
                            </CardTitle>
                            <div className="text-2xl">🎨</div>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-blue-900">
                                {stats.totalProducts}
                            </div>
                            <p className="text-xs text-blue-600 mt-1">
                                Finished paint products
                            </p>
                        </CardContent>
                    </Card>

                    <Card className="bg-gradient-to-br from-purple-50 to-purple-100 border-purple-200">
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium text-purple-800">
                                Raw Materials
                            </CardTitle>
                            <div className="text-2xl">📦</div>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-purple-900">
                                {stats.totalRawMaterials}
                            </div>
                            <p className="text-xs text-purple-600 mt-1">
                                Different raw materials
                            </p>
                        </CardContent>
                    </Card>

                    <Card className="bg-gradient-to-br from-orange-50 to-orange-100 border-orange-200">
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium text-orange-800">
                                Customers
                            </CardTitle>
                            <div className="text-2xl">👥</div>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-orange-900">
                                {stats.totalCustomers}
                            </div>
                            <p className="text-xs text-orange-600 mt-1">
                                Active customers
                            </p>
                        </CardContent>
                    </Card>
                </div>

                {/* Alerts */}
                {(stats.lowStockRawMaterials > 0 || stats.lowStockProducts > 0) && (
                    <Card className="bg-gradient-to-br from-red-50 to-red-100 border-red-200">
                        <CardHeader>
                            <CardTitle className="text-red-800 flex items-center">
                                🚨 Stock Alerts
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="flex flex-wrap gap-3">
                                {stats.lowStockRawMaterials > 0 && (
                                    <Badge variant="destructive" className="bg-red-500">
                                        {stats.lowStockRawMaterials} Raw Materials Low Stock
                                    </Badge>
                                )}
                                {stats.lowStockProducts > 0 && (
                                    <Badge variant="destructive" className="bg-red-500">
                                        {stats.lowStockProducts} Products Low Stock
                                    </Badge>
                                )}
                            </div>
                        </CardContent>
                    </Card>
                )}

                <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    {/* Quick Actions */}
                    <Card className="lg:col-span-1">
                        <CardHeader>
                            <CardTitle className="flex items-center">
                                ⚡ Quick Actions
                            </CardTitle>
                            <CardDescription>
                                Common tasks for your paint store
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-3">
                            {quickActions.map((action, index) => (
                                <Link key={index} href={action.href} className="block">
                                    <div className="flex items-center p-3 rounded-lg border hover:bg-gray-50 transition-colors cursor-pointer">
                                        <div className={`w-10 h-10 ${action.color} rounded-lg flex items-center justify-center text-white mr-3`}>
                                            {action.icon}
                                        </div>
                                        <div>
                                            <p className="font-medium text-sm">{action.title}</p>
                                            <p className="text-xs text-gray-500">{action.description}</p>
                                        </div>
                                    </div>
                                </Link>
                            ))}
                        </CardContent>
                    </Card>

                    {/* Recent Sales */}
                    <Card className="lg:col-span-2">
                        <CardHeader>
                            <CardTitle className="flex items-center justify-between">
                                <span className="flex items-center">
                                    📋 Recent Sales
                                </span>
                                <Link href="/sales">
                                    <Button variant="outline" size="sm">
                                        View All
                                    </Button>
                                </Link>
                            </CardTitle>
                            <CardDescription>
                                Latest transactions in your store
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            {recentSales.length > 0 ? (
                                <div className="space-y-3">
                                    {recentSales.map((sale) => (
                                        <div key={sale.id} className="flex items-center justify-between p-3 rounded-lg border bg-gray-50/50">
                                            <div className="flex items-center space-x-3">
                                                <div className="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                                    {sale.invoice_number.slice(-3)}
                                                </div>
                                                <div>
                                                    <p className="font-medium text-sm">
                                                        {sale.customer?.name || 'Walk-in Customer'}
                                                    </p>
                                                    <p className="text-xs text-gray-500">
                                                        {formatDate(sale.sale_date)} • {sale.cashier.name}
                                                    </p>
                                                </div>
                                            </div>
                                            <div className="text-right">
                                                <p className="font-semibold text-sm">
                                                    {formatCurrency(sale.total_amount)}
                                                </p>
                                                <Badge variant="outline" className="text-xs">
                                                    {sale.payment_method}
                                                </Badge>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8 text-gray-500">
                                    <div className="text-4xl mb-3">🛒</div>
                                    <p className="text-sm">No sales recorded yet</p>
                                    <p className="text-xs text-gray-400 mt-1">
                                        Start by creating your first sale transaction
                                    </p>
                                </div>
                            )}
                        </CardContent>
                    </Card>
                </div>

                {/* Business Insights */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center">
                            📈 Business Overview
                        </CardTitle>
                        <CardDescription>
                            Key metrics for your paint store
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div className="text-center p-4 rounded-lg bg-gradient-to-br from-green-50 to-green-100">
                                <div className="text-2xl mb-2">🏪</div>
                                <p className="text-sm font-medium text-green-800">Store Operations</p>
                                <p className="text-xs text-green-600 mt-1">Fully Operational</p>
                            </div>
                            <div className="text-center p-4 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100">
                                <div className="text-2xl mb-2">🚚</div>
                                <p className="text-sm font-medium text-blue-800">Suppliers</p>
                                <p className="text-xs text-blue-600 mt-1">{stats.totalSuppliers} Active</p>
                            </div>
                            <div className="text-center p-4 rounded-lg bg-gradient-to-br from-purple-50 to-purple-100">
                                <div className="text-2xl mb-2">💳</div>
                                <p className="text-sm font-medium text-purple-800">Payment Methods</p>
                                <p className="text-xs text-purple-600 mt-1">Cash & Transfer</p>
                            </div>
                            <div className="text-center p-4 rounded-lg bg-gradient-to-br from-orange-50 to-orange-100">
                                <div className="text-2xl mb-2">🇮🇩</div>
                                <p className="text-sm font-medium text-orange-800">Currency</p>
                                <p className="text-xs text-orange-600 mt-1">Indonesian Rupiah</p>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppShell>
    );
}