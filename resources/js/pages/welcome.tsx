import React from 'react';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';

interface Props {
    auth: {
        user: {
            id: number;
            name: string;
            email: string;
        } | null;
    };
    [key: string]: unknown;
}

export default function Welcome({ auth }: Props) {
    const features = [
        {
            icon: '📦',
            title: 'Inventory Management',
            description: 'Track raw materials and finished products with low stock alerts',
            items: ['Raw materials tracking', 'Finished products catalog', 'Stock level monitoring', 'Supplier management']
        },
        {
            icon: '💰',
            title: 'Sales Management',
            description: 'Handle retail and wholesale transactions with ease',
            items: ['Point of sale system', 'Invoice generation', 'Payment tracking', 'Customer management']
        },
        {
            icon: '📊',
            title: 'Smart Reports',
            description: 'Generate comprehensive reports for business insights',
            items: ['Daily/Monthly sales', 'Profit analysis', 'Stock reports', 'Expense tracking']
        },
        {
            icon: '👥',
            title: 'User Management',
            description: 'Role-based access for different user types',
            items: ['Admin access', 'Cashier permissions', 'Warehouse staff', 'Secure authentication']
        }
    ];

    const benefits = [
        { icon: '⚡', text: 'Real-time inventory tracking' },
        { icon: '💳', text: 'Multiple payment methods (Cash, Transfer)' },
        { icon: '🏪', text: 'Support for retail & wholesale' },
        { icon: '🔔', text: 'Low stock notifications' },
        { icon: '💹', text: 'Profit & loss analysis' },
        { icon: '🇮🇩', text: 'Indonesian Rupiah (IDR) currency' }
    ];

    return (
        <div className="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
            {/* Header */}
            <header className="border-b bg-white/80 backdrop-blur-sm sticky top-0 z-50">
                <div className="container mx-auto px-4 py-4 flex justify-between items-center">
                    <div className="flex items-center space-x-3">
                        <div className="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                            🎨
                        </div>
                        <h1 className="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            Toka Cat
                        </h1>
                    </div>
                    <div className="flex items-center space-x-4">
                        {auth.user ? (
                            <Link href="/dashboard">
                                <Button className="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700">
                                    Dashboard
                                </Button>
                            </Link>
                        ) : (
                            <div className="flex space-x-2">
                                <Link href="/login">
                                    <Button variant="outline">Login</Button>
                                </Link>
                                <Link href="/register">
                                    <Button className="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700">
                                        Register
                                    </Button>
                                </Link>
                            </div>
                        )}
                    </div>
                </div>
            </header>

            {/* Hero Section */}
            <section className="container mx-auto px-4 py-16 text-center">
                <div className="max-w-4xl mx-auto">
                    <h2 className="text-5xl font-bold mb-6 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent">
                        🎨 Professional Paint Store Management System
                    </h2>
                    <p className="text-xl text-gray-600 mb-8 leading-relaxed">
                        Complete solution for managing your paint store operations - from inventory tracking to sales management, 
                        all designed specifically for Indonesian paint retailers.
                    </p>
                    <div className="flex flex-wrap justify-center gap-3 mb-8">
                        {benefits.map((benefit, index) => (
                            <Badge key={index} variant="secondary" className="px-4 py-2 text-sm">
                                {benefit.icon} {benefit.text}
                            </Badge>
                        ))}
                    </div>
                    {!auth.user && (
                        <div className="flex justify-center space-x-4">
                            <Link href="/register">
                                <Button size="lg" className="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 px-8">
                                    🚀 Get Started Free
                                </Button>
                            </Link>
                            <Link href="/login">
                                <Button size="lg" variant="outline" className="px-8">
                                    👋 Sign In
                                </Button>
                            </Link>
                        </div>
                    )}
                </div>
            </section>

            {/* Features Grid */}
            <section className="container mx-auto px-4 py-16">
                <div className="text-center mb-12">
                    <h3 className="text-3xl font-bold mb-4 text-gray-800">
                        Everything You Need to Run Your Paint Store
                    </h3>
                    <p className="text-gray-600 max-w-2xl mx-auto">
                        From small paint shops to large retailers, Toka Cat provides all the tools you need to manage inventory, process sales, and grow your business.
                    </p>
                </div>
                
                <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {features.map((feature, index) => (
                        <Card key={index} className="hover:shadow-lg transition-shadow duration-300 border-0 bg-white/80 backdrop-blur-sm">
                            <CardHeader className="text-center">
                                <div className="text-4xl mb-3">{feature.icon}</div>
                                <CardTitle className="text-lg">{feature.title}</CardTitle>
                                <CardDescription>{feature.description}</CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="space-y-2">
                                    {feature.items.map((item, itemIndex) => (
                                        <li key={itemIndex} className="flex items-center text-sm text-gray-600">
                                            <span className="w-2 h-2 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mr-3 flex-shrink-0"></span>
                                            {item}
                                        </li>
                                    ))}
                                </ul>
                            </CardContent>
                        </Card>
                    ))}
                </div>
            </section>

            {/* Demo Screenshots Section */}
            <section className="container mx-auto px-4 py-16">
                <div className="text-center mb-12">
                    <h3 className="text-3xl font-bold mb-4 text-gray-800">
                        See Toka Cat in Action
                    </h3>
                    <p className="text-gray-600">
                        Beautiful, intuitive interface designed for Indonesian paint store owners
                    </p>
                </div>
                
                <div className="grid md:grid-cols-3 gap-6">
                    <Card className="bg-gradient-to-br from-blue-50 to-blue-100 border-blue-200">
                        <CardContent className="p-6 text-center">
                            <div className="w-16 h-16 bg-blue-500 rounded-lg mx-auto mb-4 flex items-center justify-center">
                                <span className="text-2xl text-white">📊</span>
                            </div>
                            <h4 className="font-semibold mb-2">Dashboard Overview</h4>
                            <p className="text-sm text-gray-600">Real-time sales metrics, stock levels, and business insights at a glance</p>
                        </CardContent>
                    </Card>
                    
                    <Card className="bg-gradient-to-br from-purple-50 to-purple-100 border-purple-200">
                        <CardContent className="p-6 text-center">
                            <div className="w-16 h-16 bg-purple-500 rounded-lg mx-auto mb-4 flex items-center justify-center">
                                <span className="text-2xl text-white">🛒</span>
                            </div>
                            <h4 className="font-semibold mb-2">Point of Sale</h4>
                            <p className="text-sm text-gray-600">Fast checkout process with barcode scanning and receipt printing</p>
                        </CardContent>
                    </Card>
                    
                    <Card className="bg-gradient-to-br from-indigo-50 to-indigo-100 border-indigo-200">
                        <CardContent className="p-6 text-center">
                            <div className="w-16 h-16 bg-indigo-500 rounded-lg mx-auto mb-4 flex items-center justify-center">
                                <span className="text-2xl text-white">📦</span>
                            </div>
                            <h4 className="font-semibold mb-2">Inventory Control</h4>
                            <p className="text-sm text-gray-600">Track paint colors, sizes, and raw materials with automatic reorder alerts</p>
                        </CardContent>
                    </Card>
                </div>
            </section>

            {/* CTA Section */}
            <section className="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
                <div className="container mx-auto px-4 text-center">
                    <h3 className="text-3xl font-bold mb-4">
                        Ready to Transform Your Paint Store? 🎨
                    </h3>
                    <p className="text-xl mb-8 text-blue-100">
                        Join paint store owners across Indonesia who trust Toka Cat for their business management
                    </p>
                    {!auth.user ? (
                        <div className="flex justify-center space-x-4">
                            <Link href="/register">
                                <Button size="lg" className="bg-white text-blue-600 hover:bg-gray-100 px-8">
                                    Start Free Trial
                                </Button>
                            </Link>
                            <Link href="/login">
                                <Button size="lg" variant="outline" className="border-white text-white hover:bg-white hover:text-blue-600 px-8">
                                    Sign In
                                </Button>
                            </Link>
                        </div>
                    ) : (
                        <Link href="/dashboard">
                            <Button size="lg" className="bg-white text-blue-600 hover:bg-gray-100 px-8">
                                Go to Dashboard →
                            </Button>
                        </Link>
                    )}
                </div>
            </section>

            {/* Footer */}
            <footer className="bg-gray-900 text-white py-8">
                <div className="container mx-auto px-4 text-center">
                    <div className="flex items-center justify-center space-x-3 mb-4">
                        <div className="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold">
                            🎨
                        </div>
                        <span className="text-xl font-bold">Toka Cat</span>
                    </div>
                    <p className="text-gray-400 mb-4">
                        Professional Paint Store Management System for Indonesian Retailers
                    </p>
                    <div className="flex justify-center space-x-6 text-sm text-gray-400">
                        <span>🏪 Inventory Management</span>
                        <span>💰 Sales Tracking</span>
                        <span>📊 Business Reports</span>
                        <span>👥 User Management</span>
                    </div>
                    <div className="mt-6 pt-6 border-t border-gray-800 text-sm text-gray-500">
                        <p>&copy; 2024 Toka Cat. Built for Indonesian paint store owners with ❤️</p>
                    </div>
                </div>
            </footer>
        </div>
    );
}