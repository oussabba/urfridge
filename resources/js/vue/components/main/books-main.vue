<template>
  <div class="container">
    <ad-720-300></ad-720-300>
    <last-added></last-added>
    <most-loved></most-loved>
    <book-proposal></book-proposal>
  </div>
</template>

<script>
import Ad720_300 from '../ads/ad-720-300'
import LastAddedBooks from '../last-added-books'
import MostLovedBooks from '../most-loved-books'
import BookProposal from '../propose-a-book'

export default {
  components: {
    'ad-720-300': Ad720_300,
    'last-added': LastAddedBooks,
    'most-loved': MostLovedBooks,
    'book-proposal': BookProposal
  },
}
</script>

<style scoped>
</style>