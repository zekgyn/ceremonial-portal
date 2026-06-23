<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import { DollarSign, CheckCircle, Users, Plus, Calendar, MapPin, Clock } from '@lucide/vue';

defineProps({
    events: Array,
    //   stats: Object,
})
const { user } = usePage().props.auth

const bookedVendors = [
    { id: "v2", name: "Ivory Palace Events", category: "Venue & Decoration", status: "Confirmed", date: "June 14, 2026", amount: 4500, rating: 4.8 },
    { id: "v1", name: "The Grand Feast", category: "Catering", status: "Confirmed", date: "June 14, 2026", amount: 3200, rating: 4.9 },
    { id: "v4", name: "Timeless Frames Studio", category: "Photography", status: "Pending", date: "June 14, 2026", amount: 1500, rating: 4.95 },
    { id: "v3", name: "Pulse Entertainment", category: "Entertainment", status: "Confirmed", date: "June 14, 2026", amount: 800, rating: 4.7 },
];

const timeline = [
    { date: "Jan 10, 2026", task: "Set event budget and guest list", done: true, category: "Planning" },
    { date: "Feb 5, 2026", task: "Book venue — Ivory Palace Events", done: true, category: "Venue" },
    { date: "Mar 1, 2026", task: "Confirm catering — The Grand Feast", done: true, category: "Catering" },
    { date: "Mar 20, 2026", task: "Book photographer — Timeless Frames", done: true, category: "Media" },
    { date: "Apr 15, 2026", task: "Send invitations to guests", done: true, category: "Communication" },
    { date: "May 1, 2026", task: "Confirm entertainment lineup", done: false, category: "Entertainment" },
    { date: "May 20, 2026", task: "Final menu tasting", done: false, category: "Catering" },
    { date: "Jun 1, 2026", task: "Final venue walkthrough", done: false, category: "Venue" },
    { date: "Jun 10, 2026", task: "Final payments to all vendors", done: false, category: "Finance" },
    { date: "Jun 14, 2026", task: "Wedding Day! 🎉", done: false, category: "Event" },
];

const stats = [
    {
        label: "Days Until Event",
        value: 15,
        icon: Clock,
        color: "from-amber-400 to-orange-400"
    },
    {
        label: "Budget Used",
        value: `$${(1000).toLocaleString()}`,
        icon: DollarSign,
        color: "from-rose-400 to-pink-400"
    },
    {
        label: "Vendors Booked",
        value: `${bookedVendors.filter(v => v.status === "Confirmed").length} / ${bookedVendors.length}`,
        icon: Users,
        color: "from-purple-400 to-violet-400"
    },
    {
        label: "Tasks Complete",
        value: `${timeline.filter((t) => t.done).length} / ${timeline.length}`,
        icon: CheckCircle,
        color: "from-teal-400 to-emerald-400"
    },
]
</script>

<template>

    <main class="min-h-screen bg-gray-50">
        <!-- {/* Header */} -->
        <div class="bg-linear-to-r from-rose-800 to-rose-600 py-10 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-rose-300 text-sm mb-1">Welcome back, {{ user.name.split(" ")[0] || 'Client' }} ✨
                        </p>
                        <h1 v-if="events?.length !== 0" class="text-white font-bold text-[1.75rem]">
                            Amara & David's Wedding
                        </h1>
                        <h1 v-else class="text-white font-bold text-[1.75rem]">
                            Create an event to start Planning
                        </h1>
                        <div v-if="events?.length !== 0" class="flex items-center gap-3 mt-2 flex-wrap">
                            <div class="flex items-center gap-1.5 text-rose-200 text-sm">
                                <Calendar class="size-4" />
                                June 14, 2026
                            </div>
                            <div class="flex items-center gap-1.5 text-rose-200 text-sm">
                                <MapPin class="size-4" />
                                Ivory Palace, Lagos
                            </div>
                            <div class="flex items-center gap-1.5 text-rose-200 text-sm">
                                <Users class="size-4" />
                                250 Guests
                            </div>
                        </div>
                    </div>

                    <Dialog>
                        <DialogTrigger>
                            <button v-if="events?.length === 0" class="flex items-center gap-2 px-5 py-2.5 bg-white/10 border border-white/30 text-white
                            rounded-xl hover:bg-white/20 transition-colors text-sm">
                                <Plus class="size-4" />
                                Create Event
                            </button>
                        </DialogTrigger>
                        <DialogContent>
                            <DialogHeader>
                                <DialogTitle>Are you sure absolutely sure?</DialogTitle>
                                <DialogDescription>
                                    This action cannot be undone. This will permanently delete your account
                                    and remove your data from our servers.
                                </DialogDescription>
                            </DialogHeader>
                        </DialogContent>
                    </Dialog>

                </div>

                <!-- {/* Stats */} -->
                <div v-if="events?.length !== 0" class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8">

                    <div v-for="stat in stats" :key="stat.label"
                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/10">
                        <div
                            :class="[`size-9 rounded-xl bg-linear-to-br ${stat.color} flex items-center justify-center text-white mb-2`]">
                            <component :is="stat.icon" :size="20" />
                        </div>
                        <div class="text-white font-bold text-[1.4rem]">{{ stat.value }}
                        </div>
                        <div class="text-rose-300 text-xs mt-0.5">{{ stat.label }}</div>
                    </div>

                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- {/* Tabs */} -->
            <!-- <div
                    class="flex gap-1 bg-white border border-gray-200 p-1.5 rounded-2xl w-fit mb-8 shadow-sm overflow-x-auto">
                    {tabs.map((tab) => (
                    <button key={tab.id} onClick={()=> setActiveTab(tab.id)}
                        class={`flex items-center gap-2 px-4 py-2 rounded-xl text-sm whitespace-nowrap
                        transition-all ${
                        activeTab === tab.id
                        ? "bg-gradient-to-r from-rose-500 to-amber-500 text-white shadow-sm"
                        : "text-gray-600 hover:text-gray-900"
                        }`}
                        style={{ fontWeight: activeTab === tab.id ? 600 : 400 }}
                        >
                        {tab.icon}
                        {tab.label}
                    </button>
                    ))}
                </div> -->



            <!-- {/* Budget */}
                {activeTab === "budget" && (
                <div class="grid lg:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <h2 class="text-gray-900 mb-6">Budget Breakdown</h2>
                        <div class="flex justify-center mb-6">
                            <ResponsiveContainer width={260} height={260}>
                                <PieChart>
                                    <Pie data={budgetBreakdown} cx="50%" cy="50%" innerRadius={70} outerRadius={110}
                                        paddingAngle={3} dataKey="value">
                                        {budgetBreakdown.map((entry, index) => (
                                        <Cell key={index} fill={entry.color} />
                                        ))}
                                    </Pie>
                                    <Tooltip formatter={(v: any)=> [`$${v.toLocaleString()}`, ""]} contentStyle={{
                                        borderRadius: "12px", border: "1px solid #f1f5f9" }} />
                                </PieChart>
                            </ResponsiveContainer>
                        </div>
                        <div class="space-y-3">
                            {budgetBreakdown.map((item) => (
                            <div key={item.name} className="flex items-center gap-3">
                                <div className="w-3 h-3 rounded-full" style={{ backgroundColor: item.color }} />
                                <span className="text-gray-600 text-sm flex-1">{item.name}</span>
                                <div className="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden mx-2">
                                    <div className="h-full rounded-full" style={{ width: `${(item.value / totalSpent) *
                                        100}%`, backgroundColor: item.color }} />
                                </div>
                                <span className="text-gray-900 text-sm" style={{ fontWeight: 600
                                    }}>${item.value.toLocaleString()}</span>
                            </div>
                            ))}
                        </div>
                    </div>

                    <div className="space-y-4">
                        <div className="bg-white rounded-2xl p-6 shadow-sm">
                            <h2 className="text-gray-900 mb-4">Budget Overview</h2>
                            <div className="space-y-4">
                                {[
                                { label: "Total Budget", value: totalBudget, color: "text-gray-900" },
                                { label: "Amount Spent", value: totalSpent, color: "text-rose-600" },
                                { label: "Remaining", value: totalBudget - totalSpent, color: "text-green-600" },
                                ].map((item) => (
                                <div key={item.label}
                                    className="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                                    <span className="text-gray-600 text-sm">{item.label}</span>
                                    <span className={`${item.color} text-lg`} style={{ fontWeight: 700
                                        }}>${item.value.toLocaleString()}</span>
                                </div>
                                ))}
                            </div>
                            <div className="mt-4">
                                <div className="flex justify-between text-xs text-gray-500 mb-1.5">
                                    <span>Progress</span>
                                    <span>{Math.round((totalSpent / totalBudget) * 100)}% used</span>
                                </div>
                                <div className="w-full bg-gray-100 rounded-full h-3">
                                    <div className="bg-gradient-to-r from-rose-500 to-amber-500 h-3 rounded-full"
                                        style={{ width: `${(totalSpent / totalBudget) * 100}%` }} />
                                </div>
                            </div>
                        </div>

                        <div className="bg-amber-50 border border-amber-200 rounded-2xl p-5 flex gap-3">
                            <AlertCircle className="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" />
                            <div>
                                <p className="text-amber-800 text-sm" style={{ fontWeight: 600 }}>Budget Tip</p>
                                <p className="text-amber-700 text-sm mt-0.5">You still have ${(totalBudget -
                                    totalSpent).toLocaleString()} remaining. Consider allocating some to a buffer for
                                    last-minute expenses.</p>
                            </div>
                        </div>
                    </div>
                </div>
                )}

                {/* Timeline */}
                {activeTab === "timeline" && (
                <div className="max-w-2xl">
                    <h2 className="text-gray-900 mb-6">Event Timeline</h2>
                    <div className="relative">
                        <div className="absolute left-5 top-2 bottom-2 w-0.5 bg-gray-200" />
                        <div className="space-y-4">
                            {timeline.map((task, i) => (
                            <div key={i} className="relative flex gap-4 items-start">
                                <div className={`relative z-10 w-10 h-10 rounded-full flex items-center justify-center
                                    flex-shrink-0 border-2 ${task.done ? "bg-green-500 border-green-500"
                                    : "bg-white border-gray-200" }`}>
                                    {task.done ?
                                    <CheckCircle className="w-5 h-5 text-white" /> :
                                    <Circle className="w-5 h-5 text-gray-300" />}
                                </div>
                                <div className={`flex-1 p-4 rounded-xl border transition-colors ${task.done
                                    ? "bg-green-50 border-green-100" : "bg-white border-gray-100 shadow-sm" }`}>
                                    <div className="flex items-start justify-between gap-2">
                                        <p className={`text-sm ${task.done ? "text-green-800 line-through opacity-75"
                                            : "text-gray-800" }`} style={{ fontWeight: 500 }}>
                                            {task.task}
                                        </p>
                                        <span className={`px-2 py-0.5 rounded-full text-xs flex-shrink-0
                                            ${categoryColors[task.category] || "bg-gray-100 text-gray-600" }`}>
                                            {task.category}
                                        </span>
                                    </div>
                                    <p className="text-xs text-gray-400 mt-1">{task.date}</p>
                                </div>
                            </div>
                            ))}
                        </div>
                    </div>
                </div>
                )} -->
        </div>
    </main>

</template>
