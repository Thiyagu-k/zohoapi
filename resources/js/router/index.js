import { createRouter, createWebHistory } from 'vue-router';
import LoginPage from '@/components/Login.vue';
import Home from '../components/HomePage.vue'
import CallbackPage from '@/components/CallbackPage.vue';
import DashboardPage from '@/components/DashboardPage.vue';
import ZohoSalesList from '@/pages/ZohoSalesList.vue';
import Contact from '@/pages/ContactPages.vue';
import Setting from '@/pages/SettingPage.vue';
import Items from '@/pages/ZohoItems.vue';
import OrderDetails from '@/pages/OrderDetails.vue';
import EditSalesOrder from '@/pages/EditSalesOrder.vue';
import NotFound from '@/components/NotFound.vue'

const routes = [
	{
		path: '/',
		name: 'Login',
		component: LoginPage,
	},
	{
		path: '/callback',
		name: 'Callback',
		component: CallbackPage,
	},
	{
		path: '/dashboard',
		name: 'Dashboard',
		component: DashboardPage,
		meta: { requiresAuth: true },

		children: [
			{
				path: '/home',
				component: Home,
				name: 'Home',
			},
			{
				path: '/salesList',
				component: ZohoSalesList,
				name: 'ZohosalesList',
				meta: { requiresAuth: true },

			},
			{
				path: '/contact',
				component: Contact,
				name: 'contact',
			},
			{
				path: '/setting',
				component: Setting,
				name: 'Setting',
			},
			{
				path: '/items',
				component: Items,
				name: 'Items',
			},
			{
				path: '/order/:id',
				component: OrderDetails,
				name: "OrderDetails"
			},
			{
				path: '/order/:id/edit',
				name : 'EditSalesOrder',
				component : EditSalesOrder,
			},
			{
				path: '/:pathMatch(.*)*',
				component: NotFound,
				name: 'NotFound'
			},
		]
	},
];

const router = createRouter({
	history: createWebHistory(),
	routes,
});

router.beforeEach((to, from, next) => {
	if (to.matched.some(record => record.meta.requiresAuth)) {
		const token = sessionStorage.getItem('id_token');
		if (!token) {
			next('/');
		} else {
			next();
		}
	} else {
		next();
	}
});

export default router;
