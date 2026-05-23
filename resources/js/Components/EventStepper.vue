<script setup>
defineProps({
  steps: Array,
  currentStep: Number,
})

const defaultSteps = [
  { label: 'Event Details' },
  { label: 'Catering' },
  { label: 'Venue & Décor' },
  { label: 'Entertainment' },
  { label: 'Review' },
]
</script>

<template>
  <div class="flex items-center gap-0">
    <template v-for="(step, index) in (steps ?? defaultSteps)" :key="index">
      <!-- Step -->
      <div class="flex flex-col items-center">
        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold transition-all duration-300"
             :class="index < currentStep
               ? 'bg-[#b5906b] text-white'
               : index === currentStep
                 ? 'bg-[#1c1814] text-white ring-2 ring-[#b5906b] ring-offset-2'
                 : 'bg-stone-200 text-stone-500'">
          <span v-if="index < currentStep">✓</span>
          <span v-else>{{ index + 1 }}</span>
        </div>
        <span class="mt-1.5 text-[10px] uppercase tracking-wider whitespace-nowrap hidden sm:block"
              :class="index === currentStep ? 'text-[#b5906b] font-medium' : 'text-stone-400'">
          {{ step.label }}
        </span>
      </div>

      <!-- Connector -->
      <div v-if="index < (steps ?? defaultSteps).length - 1"
           class="flex-1 h-px mx-2 mb-5 hidden sm:block"
           :class="index < currentStep ? 'bg-[#b5906b]' : 'bg-stone-200'" />
    </template>
  </div>
</template>
