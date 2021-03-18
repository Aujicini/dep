#ifndef BITUTILS_H
#define BITUTILS_H

inline int _popLsb(U64 &board) {
  int lsbIndex = __builtin_ffsll(board) - 1;
  board &= board - 1;
  return lsbIndex;
}

inline int _popCount(U64 board) {
  return __builtin_popcountll(board);
}

inline int _bitscanForward(U64 board) {
  if (board == ZERO) {
    return -1;
  }
  return __builtin_ffsll(board) - 1;
}

inline int _bitscanReverse(U64 board) {
  if (board == ZERO) {
    return -1;
  }
  return 63 - __builtin_clzll(board);
}

inline U64 _eastN(U64 board, int n) {
  U64 newBoard = board;
  for (int i = 0; i < n; i++) {
    newBoard = ((newBoard << 1) & (~FILE_A));
  }

  return newBoard;
}

inline U64 _westN(U64 board, int n) {
  U64 newBoard = board;
  for (int i = 0; i < n; i++) {
    newBoard = ((newBoard >> 1) & (~FILE_H));
  }

  return newBoard;
}

inline int _row(int square) {
  return square / 8;
}

inline int _col(int square) {
  return square % 8;
}

#endif
